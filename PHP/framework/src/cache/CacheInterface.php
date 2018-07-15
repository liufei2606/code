<?php

namespace sf\cache;

interface CacheInterface
{
    public function buildKey($key);

    public function exists($key);

    /**
     * update cache key=>value
     */

    public function set($key, $value, $duation = 0);
    public function mset($items, $duation = 0);

    public function get($key);
    public function mget($keys);

    /**
     * init cache,if exists do nothing
     *
     * @param [type] $key
     * @param [type] $value
     * @param integer $duation
     * @return void
     */
    public function add($key, $value, $duation = 0);
    public function madd($items, $duation);

    public function delete($key);

    /**
     * delete all values from cache
     *
     * @return void
     */
    public function flush();
}
