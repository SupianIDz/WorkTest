<?php

namespace Tests;

use App\Domains\Setting\Models\Setting;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @return void
     */
    protected function seedSettings() : void
    {
        Setting::createOrFirst([
            'key' => 'opening',
            'val' => '09:00',
        ]);

        Setting::createOrFirst([
            'key' => 'closing',
            'val' => '22:00',
        ]);
    }
}
