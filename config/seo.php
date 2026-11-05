<?php

$seoUrl = rtrim((string) env('SEO_URL', 'https://globalmaitri.com'), '/');

if (parse_url($seoUrl, PHP_URL_HOST) === 'globalmaitri.com') {
    $seoUrl = 'https://globalmaitri.com';
}

return [
    'url' => $seoUrl,
];
