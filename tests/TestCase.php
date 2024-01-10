<?php

namespace Tests;

use App\Clients\Contracts\SafeUrlCheckContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Http::preventStrayRequests();
    }

    protected function setSafeUrlContractInstance(bool $isUrlSafe): MockInterface
    {
        $mock = $this->mock(SafeUrlCheckContract::class, function (MockInterface $mock) use ($isUrlSafe) {
            $mock->shouldReceive('isUrlSafe')->andReturn($isUrlSafe);
        });

        $this->app->instance(SafeUrlCheckContract::class, $mock);

        return $mock;
    }
}
