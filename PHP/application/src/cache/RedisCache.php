<?php

namespace sf\cache;

use Redis;
use sf\base\Component;
use Expection;

class RedisCache extends Component implements CacheInterface
{
    public $redis;

    public function init()
    {
        if (is_array($this->redis)) {
            extract($this->redis);

            $redis = new Redis();
            $redis->connect($host, $port);

            if (!empty($password)) {
                $redis->auth($password);
            }
            $redis->select($database);
            if (!empty($options)) {
                call_user_func_array([$redis, 'setOptions'], $options);
            }
            $this->redis = $redis;
        }
        if (!$this->redis instanceof Redis) {
            throw new Exception('Cache::reids must be either a Redis connection isntance.');
        }
    }

    public function buildKey($key)
    {
        if (!is_string($key)) {
            $key = json_encode($key);
        }

        return md5($key);
    }

    public function get($key)
    {
        $key = $this->buildKey($key);
        return $this->redis->get($key);
    }

    public function exists($key)
    {
        $key = $this->buildKey($key);
        return $this->redis->exists($key);
    }

    public function mget($keys)
    {
        for ($i=0; $i < count($keys); $i++) {
            $keys[$i] = $this->buildKey($keys[$i]);
        }
        return $this->redis->mget($keys);
    }

    public function set($key, $value, $duration = 0)
    {
        $key = $this->buildKey($key);
        if ($duration !== 0) {
            $duration = (int)$duration * 1000;
            return $this->redis->set($key, $value, $duration);
        }
        return $this->redis->set($key, $value);
    }

    public function mset($items, $duation = 0)
    {
        $failedKeys = [];
        foreach ($items as $k => $v) {
            if ($this->redis->set($k, $v, $duration) === false) {
                $failedKeys[] = $k;
            }
        }

        return $failedKeys;
    }

    public function add($key, $value, $duration = 0)
    {
        if (!$this->exists($key)) {
            return $this->redis->set($key, $value, $duration);
        }

        return false;
    }

    public function madd($items, $duation)
    {
        $failedKeys = [];
        foreach ($items as $key => $value) {
            if ($this->add($key, $value, $duration) === false) {
                $failedKeys[] = $key;
            }
        }

        return $failedKeys;
    }

    public function delete($key)
    {
        $key = $this->buildKey($key);
        return $this->redis->delete($key);
    }

    public function flush()
    {
        return $this->redis->flushDb();
    }
}
