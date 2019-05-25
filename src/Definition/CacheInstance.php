<?php


namespace oukhennicheabdelkrim\DIC\Definition;


class CacheInstance implements CacheInstanceInterface
{
    private $store = [];

    public function has($key): bool
    {
        return isset($this->store[$key]);
    }

    public function put($id, $resolve)
    {
        $this->store[$id] = $resolve;
    }

    public function remove($key)
    {
        if ($this->has($key)) unset($this->store[$key]);
    }

    public function get($key)
    {
        if ($this->has($key)) return $this->store[$key];


    }
}
