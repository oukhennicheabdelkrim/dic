<?php

namespace oukhennicheabdelkrim\DIC;

use oukhennicheabdelkrim\DIC\Definition\CacheInstance;
use oukhennicheabdelkrim\DIC\Definition\Resolver;


use Psr\Container\ContainerInterface;


/**
 * Class DIC
 * @package oukhennicheabdelkrim\DIC
 */
class DIC implements ContainerInterface
{

    /**
     * @var Resolver
     */
     private $resolver;

    /**
     * DIC constructor.
     * @param ContainerInterface|null $container
     */
    public function __construct(ContainerInterface $container=null)
     {
         if ($container===null)
             $container=$this;

         $this->resolver = new Resolver(new CacheInstance(),$container);
     }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        return $this->resolver->resolve($id);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return $this->resolver->canResolve($id);
    }


    /**
     * set id  Instance
     * @param $id
     * @param  mixed
     * $resolve can be a callable to resolve the instance or any type
     */

    public function bind($id, $resolve)
    {
        $this->resolver->register($id,$resolve);
        return $this;
    }


    /**
     * GET a new Instance
     * @param $id
     * @param  mixed
     * $resolve can be a callable to resolve the instance or any type
     */

    public function getFactory($id)
    {
        return $this->resolver->resolve($id,false);
    }

}
