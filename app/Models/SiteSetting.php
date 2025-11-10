<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value_fr',
        'value_en',
        'type',
        'group'
    ];

    // Helper method to get setting value
    public static function get($key, $locale = 'fr', $default = null)
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        $field = 'value_' . $locale;
        return $setting->$field ?? $setting->value_fr ?? $default;
    }

    // Helper method to set setting value
    public static function set($key, $valueFr, $valueEn = null, $type = 'text', $group = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value_fr' => $valueFr,
                'value_en' => $valueEn ?? $valueFr,
                'type' => $type,
                'group' => $group
            ]
        );
    }
}
