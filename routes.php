<?php declare(strict_types=1);

return [
    ['GET', '/', ['App\Controllers\ProductController', 'index']],
    ['GET', '/add-product', ['App\Controllers\ProductController', 'show']],

    ['POST', '/product', ['App\Controllers\ProductController', 'create']],
];