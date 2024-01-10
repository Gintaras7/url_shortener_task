<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Services\Links\LinkHashService;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    public function test_page_by_hash_not_found(): void
    {
        $this
            ->get(route('page.show', ['hash' => '123456']))
            ->assertNotFound();
    }

    public function test_redirect_to_external_page(): void
    {
        $link = Link::factory()->create([
            'url' => 'https://example.net',
            'hash' => LinkHashService::generate(),
        ]);

        $this->assertDatabaseCount(Link::class, 1);

        $this
            ->get(route('page.show', ['hash' => $link->hash]))
            ->assertRedirect()
            ->assertHeader('Location', $link->url);
    }
}
