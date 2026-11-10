<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    /**
     * Securely serve photo: unblurred only if authorized, otherwise server-side blurred (FR-2.2).
     */
    public function show(Request $request, Photo $photo): Response
    {
        if (! $photo->profile?->user?->is_active) {
            return $this->serveSvgSilhouette($photo);
        }

        $viewer = Auth::user();
        $photoOwner = $photo->profile?->user;

        if ($viewer && ! $viewer->is_active) {
            return $this->serveSvgSilhouette($photo);
        }

        if ($viewer && $photoOwner && $viewer->hasBlockedRelationshipWith($photoOwner)) {
            return $this->serveSvgSilhouette($photo);
        }

        $isAuthorized = $photo->profile?->isPhotoVisibleTo($viewer);

        if ($photo->is_private && ! ($viewer && ($viewer->id === $photoOwner?->id || $viewer->isAdmin() || $viewer->isModerator() || $photo->profile?->photoAccessGrants()->where('granted_to_user_id', $viewer->id)->where('status', 'active')->exists()))) {
            $isAuthorized = false;
        }

        if ($isAuthorized) {
            return $this->serveOriginal($photo);
        }

        return $this->serveBlurred($photo);
    }

    protected function serveOriginal(Photo $photo): Response
    {
        $filePath = $photo->file_path;

        // If external URL (e.g. Unsplash demo image)
        if ($this->isTrustedExternalImageUrl($filePath)) {
            return redirect()->away($filePath);
        }

        // Local photos are private and can only be served after authorization.
        if (Storage::disk('private')->exists($filePath)) {
            $fullPath = Storage::disk('private')->path($filePath);
            $mime = mime_content_type($fullPath) ?: 'image/jpeg';

            return response()->file($fullPath, [
                'Content-Type' => $mime,
                'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
            ]);
        }

        return $this->serveSvgSilhouette($photo);
    }

    protected function serveBlurred(Photo $photo): Response
    {
        $cacheDir = storage_path('app/blurred-photos');
        if (! is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        $cacheFile = $cacheDir.'/blurred_'.$photo->id.'.jpg';

        if (file_exists($cacheFile)) {
            return response()->file($cacheFile, [
                'Content-Type' => 'image/jpeg',
                'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
            ]);
        }

        // Generate blurred version using GD
        $imageData = null;
        $filePath = $photo->file_path;

        if ($this->isTrustedExternalImageUrl($filePath)) {
            try {
                $res = Http::timeout(4)->get($filePath);
                if ($res->successful()) {
                    $imageData = $res->body();
                }
            } catch (\Throwable $e) {
                // fall through to SVG
            }
        } elseif (Storage::disk('private')->exists($filePath)) {
            $imageData = Storage::disk('private')->get($filePath);
        }

        if ($imageData && extension_loaded('gd')) {
            try {
                $im = @imagecreatefromstring($imageData);
                if ($im !== false) {
                    // Downscale slightly for stronger blur effect
                    $w = imagesx($im);
                    $h = imagesy($im);
                    $targetW = min(300, $w);
                    $targetH = (int) ($h * ($targetW / $w));

                    $thumb = imagecreatetruecolor($targetW, $targetH);
                    imagecopyresampled($thumb, $im, 0, 0, 0, 0, $targetW, $targetH, $w, $h);
                    imagedestroy($im);

                    // Apply strong pixelation & multiple passes of Gaussian blur
                    imagefilter($thumb, IMG_FILTER_PIXELATE, 22);
                    for ($i = 0; $i < 10; $i++) {
                        imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
                    }

                    imagejpeg($thumb, $cacheFile, 65);
                    imagedestroy($thumb);

                    return response()->file($cacheFile, [
                        'Content-Type' => 'image/jpeg',
                        'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
                    ]);
                }
            } catch (\Throwable $e) {
                // fall through
            }
        }

        return $this->serveSvgSilhouette($photo);
    }

    private function isTrustedExternalImageUrl(string $url): bool
    {
        $parsedUrl = parse_url($url);

        return ($parsedUrl['scheme'] ?? null) === 'https'
            && ($parsedUrl['host'] ?? null) === 'images.unsplash.com';
    }

    protected function serveSvgSilhouette(Photo $photo): Response
    {
        $label = 'Lotus Privacy Shield Active (Global Maitri)';

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400">
  <defs>
    <linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#881337" />
      <stop offset="50%" stop-color="#4c0519" />
      <stop offset="100%" stop-color="#1f2937" />
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" fill="url(#g)" />
  <circle cx="200" cy="170" r="75" fill="#f43f5e" opacity="0.25" />
  <g transform="translate(160, 130) scale(3.5)" fill="#fbcfe8" opacity="0.9">
    <path d="M12 2C12 2 8 8 8 13C8 16 10 18 12 18C14 18 16 16 16 13C16 8 12 2 12 2Z"/>
    <path d="M7 8C7 8 3 12 3 15C3 18 5 20 8 19C9 18 8 14 7 8Z" opacity="0.8"/>
    <path d="M17 8C17 8 21 12 21 15C21 18 19 20 16 19C15 18 16 14 17 8Z" opacity="0.8"/>
  </g>
  <rect x="50" y="275" width="300" height="36" rx="18" fill="#000000" opacity="0.65" />
  <text x="200" y="298" font-size="12" font-weight="bold" fill="#fef08a" text-anchor="middle" font-family="sans-serif">🔒 {$label}</text>
</svg>
SVG;

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
        ]);
    }
}
