<?php
declare(strict_types=1);

namespace Enries\Framework\Container;

use Enries\Framework\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object $concrete = null): static
    {
        if (is_null($concrete)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service with $id is not found");
            }
            $concrete = $id;
        }
        $this->services[$id] = $concrete;
        return $this;
    }
    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service with $id cant be resolved");
            }
            $this->add($id);
        }
        return $this->resolve($this->services[$id]);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    /**
     * @throws \ReflectionException
     */
    public function resolve ($class)
    {
        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        if (is_null($constructor)) {
            return $reflectionClass->newInstance();
        }
        $params = $constructor->getParameters();

        $classDeps = $this->resolveClassDeps($params);

        return $reflectionClass->newInstanceArgs($classDeps);
    }

    private function resolveClassDeps(array $params): array
    {
        $deps = [];
        /** @var \ReflectionParameter $param */
        foreach ($params as $param) {
            $paramType = $param->getType();
            $service = $this->get($paramType->getName());
            $deps[] = $service;
        }
        return $deps;
    }
}