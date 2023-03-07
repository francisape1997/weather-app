<?php

namespace App\Interfaces;

interface ICacheService
{
    /**
     * Get the value from the cache if it exists.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key): mixed;

    /**
     * Set a value in the cache with an expiration time.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     */
    public function set(string $key, mixed $value, ?int $ttl);

    /**
     * Remove the value from the cache.
     *
     * @param string $key
     */
    public function delete(string $key);
}
