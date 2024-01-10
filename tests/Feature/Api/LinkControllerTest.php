<?php

namespace Feature\Api;

use App\Clients\Contracts\SafeUrlCheckContract;
use App\Models\Link;
use App\Services\Links\LinkHashService;
use Tests\TestCase;

class LinkControllerTest extends TestCase
{
    public static function provideInvalidUrlDataForValidation(): array
    {
        return [
            [['url' => 'google']],
            [['url' => 'invalid_url']],
            [['url' => 'http://invalid domain.com']],
            [[]],
        ];
    }

    /**
     * @dataProvider provideInvalidUrlDataForValidation
     */
    public function test_posting_invalid_payload_returns_validation_error(array $payload): void
    {
        $this->setSafeUrlContractInstance(isUrlSafe: true);

        $this
            ->postJson(route('links.storeLink'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['url']);
    }

    public function test_existing_url_hash_is_returned_from_database(): void
    {
        $this->setSafeUrlContractInstance(isUrlSafe: true);

        $link = Link::factory()->create(['hash' => LinkHashService::generate()]);
        $this->assertDatabaseCount(Link::class, 1);

        $this
            ->post(route('links.storeLink'), ['url' => $link->url])
            ->assertOk()
            ->assertJson(['hash' => $link->hash]);

        app(SafeUrlCheckContract::class)->shouldNotHaveReceived('isUrlSafe');
        $this->assertDatabaseCount(Link::class, 1);
    }

    public function test_url_and_hash_created(): void
    {
        $link = Link::factory()->make();

        $this->setSafeUrlContractInstance(isUrlSafe: true);
        $this->assertDatabaseCount(Link::class, 0);

        $this
            ->post(route('links.storeLink'), ['url' => $link->url])
            ->assertCreated()
            ->assertJsonStructure([
                'shortened_link',
                'hash',
            ]);

        app(SafeUrlCheckContract::class)->shouldHaveReceived('isUrlSafe')->once();

        $this
            ->assertDatabaseHas('links', ['url' => $link->url])
            ->assertDatabaseCount(Link::class, 1);
    }

    public function test_link_is_unsafe(): void
    {
        $this->setSafeUrlContractInstance(isUrlSafe: false);
        $this->assertDatabaseCount(Link::class, 0);

        $this
            ->post(route('links.storeLink'), ['url' => 'https://example.net'])
            ->assertBadRequest();

        app(SafeUrlCheckContract::class)->shouldHaveReceived('isUrlSafe')->once();
        $this->assertDatabaseCount(Link::class, 0);
    }
}
