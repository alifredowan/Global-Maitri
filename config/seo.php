<?php

$seoUrl = rtrim((string) env('SEO_URL', 'https://globalvivaha.com'), '/');

if (parse_url($seoUrl, PHP_URL_HOST) === 'globalvivaha.com' || parse_url($seoUrl, PHP_URL_HOST) === 'globalmaitri.com') {
    $seoUrl = 'https://globalvivaha.com';
}

return [
    'url' => $seoUrl,
];
