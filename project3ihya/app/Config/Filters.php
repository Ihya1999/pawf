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

// 🔥 TAMBAHAN DARI Myth/Auth
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

        // 🔥 Myth/Auth Filters
        'login'         => LoginFilter::class,
        'role'          => RoleFilter::class,
        'permission'    => PermissionFilter::class,
    ];

    public array $required = [
        'before' => [
            // 'forcehttps', // aktifin kalau pakai HTTPS
            // 'pagecache',
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
        // 🔥 WAJIB LOGIN untuk semua halaman admin
        'login' => ['before' => ['admin/*']],

        // 🔥 CONTOH ROLE (optional, bisa lu pakai nanti)
        // 'role:admin' => ['before' => ['admin/*']],
        // 'role:pengurus' => ['before' => ['pengurus/*']],
        // 'role:anggota' => ['before' => ['anggota/*']],
    ];
}