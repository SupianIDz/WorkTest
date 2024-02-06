<?php

namespace App\Support;

use Illuminate\Contracts\Support\Arrayable;

abstract class Entity implements Arrayable
{
    /**
     * @param  array $data
     */
    public function __construct(protected array $data = [])
    {
        //
    }

    /**
     * @param  string $name
     * @param  array  $arguments
     * @return $this|Entity|mixed|void|null
     */
    public function __call(string $name, array $arguments)
    {
        $key = str($name)->snake();

        if ($key->before('_')->is('set')) {
            return $this->set($key->after('_'), $arguments[0] ?? null);
        }

        if ($key->before('_')->is('get')) {
            return $this->get($key->after('_'));
        }

        if ($key->before('_')->is('has')) {
            return $this->has($key->after('_'));
        }
    }

    /**
     * @param  string $key
     * @param  mixed  $val
     * @return $this
     */
    public function set(string $key, mixed $val) : static
    {
        $this->data[$key] = $val;

        return $this;
    }

    /**
     * @param  string $key
     * @return mixed|null
     */
    public function get(string $key) : mixed
    {
        return $this->data[$key];
    }

    /**
     * @param  string $key
     * @return bool
     */
    public function has(string $key) : bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->data;
    }
}
