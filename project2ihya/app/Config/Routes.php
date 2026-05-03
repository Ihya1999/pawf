<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route utama (homepage)
$routes->get('/', 'Home::index');

// Custom halaman 404
$routes->set404Override(function () {
    echo view('errors/not_found');
});

// Route halaman lain
$routes->get('/portfolio', 'Portfolio::index');
$routes->get('/about', 'About::index');
