<?php

namespace Enries\Framework\Tests;

use Enries\Framework\Container\Container;
use Enries\Framework\Container\ContainerTestClass;
use Enries\Framework\Container\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ContainerTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ContainerException
     */
    public function test_getting_service_from_container ()
    {
        $container = new Container();
        $key = 'container-test-class';
        $container->add($key, ContainerTestClass::class);

        $instance = $container->get($key);
        $this->assertInstanceOf(ContainerTestClass::class, $instance);
    }

    public function test_when_container_not_found ()
    {
        $container = new Container();
        $this->expectException(ContainerException::class);
        $container->add('no-class');
    }
    public function test_has_method_should_return_true ()
    {
        $container = new Container();
        $key = 'adsda';
        $container->add($key, ContainerTestClass::class);

        $this->assertTrue($container->has($key));
    }

    public function test_recursively_auto_wired ()
    {
        $container = new Container();
        $container->add('class-a',  ClassA::class);
        $container->add('class-b',  ClassB::class);

        /** @var ClassB $instance */
        $instance = $container->get('class-b');

        $this->assertInstanceOf(ClassA::class, $instance->getA());
    }

    public function test_recursively_auto_wired_three_class ()
    {
        $container = new Container();
        $container
            ->add('class-a',  ClassA::class)
            ->add('class-b',  ClassB::class)
            ->add('class-c', ClassC::class);

        /** @var ClassC $instance */
        $instance = $container->get('class-c');

        $this->assertInstanceOf(ClassA::class, $instance->getClassA());
        $this->assertInstanceOf(ClassB::class, $instance->getClassB());
    }
}