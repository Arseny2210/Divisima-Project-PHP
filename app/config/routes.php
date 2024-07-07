<?
return [
    PATH . "/" => [
        'controller' => 'main',
        'action' => 'index'
    ],
    PATH . "/search" => [
        'controller' => 'search',
        'action' => 'index'
    ],
    // Fetch routes
    PATH . "categoryProductsHandler" => [
        'controller' => 'main',
        'action' => 'categoryProductsHandler'
    ],
];