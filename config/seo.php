<?php

return [
    'organization_name' => env('SEO_ORGANIZATION_NAME', env('APP_NAME', 'GKKA Samarinda')),
    'legal_name' => env('SEO_LEGAL_NAME', env('APP_NAME', 'GKKA Samarinda')),
    'logo_path' => env('SEO_LOGO_PATH', 'favicon.ico'),
    'phone' => env('SEO_PHONE', '+62-823-5052-6337'),
    'email' => env('SEO_EMAIL', 'gkkaisamarinda@yahoo.com'),
    'price_range' => env('SEO_PRICE_RANGE', 'Free'),
    'map_url' => env('SEO_MAP_URL', 'https://www.google.com/maps/search/?api=1&query=GKKA+Samarinda'),
    'same_as' => array_values(array_filter(array_map('trim', explode(',', (string) env('SEO_SAME_AS', ''))))),
    'address' => [
        'street' => env('SEO_ADDRESS_STREET', 'Jl. Sentosa No.25, Sungai Pinang Dalam'),
        'locality' => env('SEO_ADDRESS_LOCALITY', 'Samarinda'),
        'region' => env('SEO_ADDRESS_REGION', 'Kalimantan Timur'),
        'postal_code' => env('SEO_ADDRESS_POSTAL_CODE', '75117'),
        'country' => env('SEO_ADDRESS_COUNTRY', 'ID'),
    ],
    'geo' => [
        'latitude' => env('SEO_GEO_LATITUDE'),
        'longitude' => env('SEO_GEO_LONGITUDE'),
    ],
];
