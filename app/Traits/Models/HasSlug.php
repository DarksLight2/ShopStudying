<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $item) {
            $slug = $item->slug ??
                Str::slug($item->{self::slugFrom()});

            $i = 0;

            $item->slug = self::similarSlugCounter($slug, $item, $i);
        });
    }

    protected static function similarSlugCounter(string $slug, Model $model, int &$i, string $param = ''): string
    {
        $count = $model->query()
            ->where('slug', $slug . $param)
            ->count();

        if ($count !== 0) {
            $i++;
            return self::similarSlugCounter($slug, $model, $i, '-' . $i);
        }

        return $slug . $param;
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}