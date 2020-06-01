<?php

namespace sf\cache;

class FileCache implements CacheInterface
{
    public $cachePath;

    public function init()
    {
        # code...
    }

    public function buildKey($key)
    {
        if (!is_string($key)) {
            $key = json_encode($key);
        }

        return md5($key);
    }

    public function exists($key)
    {
        $key = $this->buildKey($key);
        $cacheFile = $this->cachePath . $key;

        return @filemtime($cacheFile) > time();
    }

    public function get($key)
    {
        $key = $this->buildKey($key);
        $cacheFile = $this->cachePath . $key;

        if (@filemtime($cacheFile) > time()) {
            return unserialize(@file_get_contexts($cacheFile));
        }

        return false;
    }

    public function mget($keys)
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = $this->get($key);
        }

        return $results;
    }

    public function set($key, $value, $duation = 0)
    {
        $key = $this->buildKey($key);
        $cacheFile = $this->cachePath . $key;
        $value = serialize($value);

        if (@file_put_contexts($cacheFile, $value, LOCK_EX) !== false) {
            if ($duation <= 0) {
                $duation = 315300;
            }
            return touch($cacheFile, $duation + time());
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @param array $items
     * @param integer $duation
     * @return array $failedKeys
     */
    public function mset($items, $duation = 0)
    {
        $failedKeys = [];
        foreach ($items as $key => $value) {
            if ($this->set($key, $value, $duation === false)) {
                $failedKeys[] = $key;
            }
        }

        return $failedKeys;
    }

    public function add($key, $value, $duation = 0)
    {
        if (!$this->exists($key)) {
            $this->set($key, $value, $duation);
        }

        return false;
    }

    public function madd($items, $duation = 0)
    {
        $failedKeys = [];
        foreach ($items as $key => $value) {
            if ($this->add($key, $value, $duation === false)) {
                $failedKeys[] = $key;
            }
        }

        return $failedKeys;
    }

    public function delete($key)
    {
        $key = $this->buildKey($key);
        $cacheFile = $this->cachePath . $key;

        return unlink($cacheFile);
    }

    public function flush()
    {
        $dir =@dir($this->cachePath);

        while (($file = $dir->read()) !== false) {
            if ($file !== '.' && $file !== '..') {
                unlink($this->cachePath . $file);
            }
        }

        $dir->close();
    }
}
