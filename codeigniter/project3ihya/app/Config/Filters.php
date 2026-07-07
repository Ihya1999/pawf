<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

// Myth/Auth
use Myth\Auth\Filters\LoginFilter;
use Myth\Auth\Filters\PermissionFilter;
use Myth\Auth\Filters\RoleFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // Myth/Auth
        'login'         => LoginFilter::class,
        'role'          => RoleFilter::class,
        'permission'    => PermissionFilter::class,
    ];

    public array $required = [
        'before' => [
            // 'forcehttps',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            // 'csrf',
        ],
        'after' => [
            // 'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        //Proteksi semua halaman admin
        'login' => [
            'before' => [
                'admin/*',
                '-admin/logout' //penting: biar logout gak diblok
            ],
        ],

        // opsi (kalau nanti mau pakai role)
        // 'role:admin' => ['before' => ['admin/*']],
    ];
}