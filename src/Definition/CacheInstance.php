<?php


namespace oukhennicheabdelkrim\DIC\Definition;


/**
 * Class CacheInstance
 * @package oukhennicheabdelkrim\DIC\Definition
 */
class CacheInstance implements CacheInstanceInterface
{
    /**
     * @var array
     */
    private $store = [];

    /**
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return isset($this->store[$key]);
    }

    /**
     * @param $id
     * @param $resolve
     * @return mixed|void
     */
    public function put($id, $resolve)
    {
        $this->store[$id] = $resolve;
    }

    /**
     * @param $key string
     * @return mixed|void
     */
    public function remove($key)
    {
        if ($this->has($key)) unset($this->store[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if ($this->has($key)) return $this->store[$key];

    }
}
