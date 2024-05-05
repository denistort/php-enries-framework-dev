<?php
declare(strict_types=1);

namespace Enries\Framework\Contracts;

use Enries\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}