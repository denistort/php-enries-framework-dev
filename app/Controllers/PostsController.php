<?php

namespace App\Controllers;

use Enries\Framework\Http\Request;
use Enries\Framework\Http\Response;

class PostsController
{
    public function show(int $id): Response
    {
        return (new Response())->setContent("<h1>Post with {$id}</h1>");
    }
}