<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    /**
     * Get setting by code
     *
     * @param string $key
     */
    public function getByKey(string $key)
    {
        return Setting::query()->where('key', $key)->first('value');
    }
}
