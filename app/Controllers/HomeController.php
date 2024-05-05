<?php

namespace App\Controllers;

use Enries\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h1>Home controller</h1>';
        return (new Response())->setContent($content);
    }
}