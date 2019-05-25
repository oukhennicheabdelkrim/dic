<?php

namespace oukhennicheabdelkrim\DIC\Definition;


/**
 * Interface CacheInstanceInterface
 * @package oukhennicheabdelkrim\DIC\Definition
 */
interface CacheInstanceInterface
{
    /**
     * @param $key
     * @return bool
     */
    public function has($key):bool;

    /**
     * @param $id
     * @param $resolve
     * @return mixed
     */
    public function put($id, $resolve);

    /**
     * @param $key
     * @return mixed
     */
    public function remove($key);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);



}
