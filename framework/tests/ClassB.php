<?php

namespace Enries\Framework\Tests;

class ClassB
{
    public function __construct(private readonly ClassA $dep)
    {
    }

    public function getA (): ClassA
    {
        return $this->dep;
    }

}