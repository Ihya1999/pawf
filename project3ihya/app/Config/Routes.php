<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

$routes->get('/post', 'Post::index');
$routes->get('/post/(:any)', 'Post::viewPost/$1');


// ================= ADMIN =================
$routes->group('admin', ['filter' => 'login'], function($routes) {

    $routes->get('post', 'PostAdmin::index');

    $routes->get('post/(:segment)/preview', 'PostAdmin::preview/$1');

    $routes->get('post/new', 'PostAdmin::create');
    $routes->post('post/new', 'PostAdmin::store');


    $routes->post('post/uploadImage', 'PostAdmin::uploadImage');

    $routes->get('post/(:segment)/edit', 'PostAdmin::edit/$1');
    $routes->post('post/(:segment)/edit', 'PostAdmin::update/$1');

    $routes->get('post/(:segment)/delete', 'PostAdmin::delete/$1');

    $routes->get('logout', 'Auth::logout');
});