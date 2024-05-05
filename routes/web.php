<?php

use Enries\Framework\Routing\Route;
use App\Controllers\{HomeController, PostsController};

return [
    Route::GET('/', [HomeController::class, 'index']),
    Route::GET('/posts/{id}', function (string $id) {
        return (new \Enries\Framework\Http\Response())->setContent("{$id}");
    }),
];