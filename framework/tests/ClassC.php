<?php

namespace Enries\Framework\Tests;

class ClassC
{
    public function __construct(private readonly ClassA $classA, private readonly ClassB $classB)
    {
    }


    /**
     * @return ClassA
     */
    public function getClassA(): ClassA
    {
        return $this->classA;
    }

    /**
     * @return ClassB
     */
    public function getClassB(): ClassB
    {
        return $this->classB;
    }
}