<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    /**
     * Return the index layout to use for a tag
     *
     * @param string $tag
     * @param string $default
     * @return string
     */
    public static function getLayout($slug, $default = 'index')
    {
        $layout = static::whereSlug($slug)->value('layout');

        return $layout ?: $default;
    }
}
