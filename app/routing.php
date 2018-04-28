<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Item' => [ // Controller
        ['index', '/item/', 'GET'], // action, url, method
        ['add', '/item/add', 'GET'], // action, url, method
        ['edit', '/item/edit/{id:\d+}', 'GET'], // action, url, method
        ['show', '/item/{id:\d+}', 'GET'], // action, url, method
    ],
    'Contact' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
        ['show', '/contact/{id:\d+}', 'GET'], // action, url, method
        ['add', '/contact/add', 'GET'], // action, url, method
        ['edit', '/contact/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['delete', '/contact/delete/{id:\d+}', 'GET'], // action, url, method
    ],
];
