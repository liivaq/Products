<?php declare(strict_types=1);

return [
    ['GET', '/', ['App\Controllers\ProductController', 'index']],
    ['GET', '/add-product', ['App\Controllers\ProductController', 'create']],

    ['POST', '/product', ['App\Controllers\ProductController', 'store']],

    ['POST', '/delete', ['App\Controllers\ProductController', 'delete']],

    ['POST', '/validate', ['App\Controllers\ProductController', 'validate']]
];