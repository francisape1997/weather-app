<?php

namespace App\Services\Cache;

use App\Interfaces\ICacheService;
use Illuminate\Support\Facades\Redis;

class RedisCacheService implements ICacheService
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return Redis::get($key);
    }

    /**
     * [1 hour is default expiration]
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     */
    public function set(string $key, mixed $value, ?int $ttl = 3600)
    {
        Redis::set($key, $value, 'ex', $ttl);
    }

    /**
     * @param string $key
     */
    public function delete(string $key)
    {
        Redis::del($key);
    }
}
