<?php

namespace Tests\Unit\Links;

use App\Models\Link;
use App\Services\Links\LinkHashService;
use Tests\TestCase;

class LinkHashServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_hash_length_must_be_6_chars(): void
    {
        $hash = app(LinkHashService::class)->generateValidHash();

        $this->assertEquals(Link::HASH_LENGTH, strlen($hash));
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $hash);
    }
}
