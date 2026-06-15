<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Centrova | AI Venture Engineering, Software Development & AI Agent Automation',
            'titleBefore'  => false,
            'description'  => 'PT Centrova Teknologi Indonesia - AI Venture Engineering company spesialis Software Development, AI-powered Systems, dan AI Agent Automation untuk transformasi digital bisnis Anda.',
            'separator'    => ' | ',
            'keywords'     => ['Centrova', 'PT Centrova Teknologi Indonesia', 'AI Venture Engineering', 'Software Development', 'AI Agent Automation', 'Artificial Intelligence Indonesia', 'centrova.id', 'AI Solutions', 'Business Automation', 'digital transformation', 'web development Indonesia'],
            'canonical'    => 'current',
            'robots'       => 'index,follow',
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => env('GOOGLE_SITE_VERIFICATION', null),
            'bing'      => env('BING_SITE_VERIFICATION', null),
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => env('YANDEX_SITE_VERIFICATION', null),
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Centrova | AI Venture Engineering, Software Development & AI Agent Automation',
            'description' => 'PT Centrova Teknologi Indonesia - AI Venture Engineering company spesialis Software Development, AI-powered Systems, dan AI Agent Automation untuk transformasi digital bisnis Anda.',
            'url'         => 'current',
            'type'        => 'website',
            'site_name'   => 'Centrova',
            'images'      => [env('APP_URL', 'https://centrova.id') . '/thumbnail.png'],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => env('TWITTER_SITE', '@centrova_id'),
            'creator'     => env('TWITTER_CREATOR', '@centrova_id'),
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => env('APP_NAME', 'Centrova'), // set false to total remove
            'description' => 'Centrova - Platform digital terdepan untuk solusi web development, hosting, dan layanan teknologi modern di Indonesia', // set false to total remove
            'url'         => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [env('APP_URL', 'https://centrova.id') . '/assets/images/centrova-og-image.jpg'],
        ],
    ],
];
