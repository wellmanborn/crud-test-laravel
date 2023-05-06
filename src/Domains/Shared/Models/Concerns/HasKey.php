<?php

declare(strict_types=1);

namespace Src\Domains\Shared\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasKey
{
    public static function bootHasKey(): void
    {
        static::creating(
            fn(Model $model) => $model->key = Str::uuid()->toString()
        );
    }
}
