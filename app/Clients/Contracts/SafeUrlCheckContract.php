<?php

declare(strict_types=1);

namespace App\Clients\Contracts;

use GuzzleHttp\Exception\RequestException;

interface SafeUrlCheckContract
{
    /**
     * @throws RequestException
     *
     * @returns bool
     */
    public function isUrlSafe(string $url): bool;
}
