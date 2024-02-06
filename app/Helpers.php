<?php

/**
 * @param  string $key
 * @param  mixed  $default
 * @return mixed
 */
function setting(string $key, mixed $default = null) : mixed
{
    $query = \App\Domains\Setting\Models\Setting::where('key', $key);
    if ($query->exists()) {
        return $query->first()->val;
    }

    return $default;
}
