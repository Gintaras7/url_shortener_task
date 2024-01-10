<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $url
 * @property string $hash
 * @property-read string $shortened_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Link extends Model
{
    use HasFactory;

    public const HASH_LENGTH = 6;

    protected $fillable = [
        'url',
        'hash',
    ];

    protected function shortenedLink(): Attribute
    {
        return new Attribute(
            get: fn () => url(route('page.show', ['hash' => $this->hash])),
        );
    }
}
