<?php

declare(strict_types=1);

namespace App\Services\Links;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkHashService
{
    public function generateValidHash(): string
    {
        $hash = self::generate();

        while (Link::where('hash', $hash)->exists()) {
            $hash = self::generate();
        }

        return $hash;
    }

    public static function generate(): string
    {
        return Str::random(Link::HASH_LENGTH);
    }
}
