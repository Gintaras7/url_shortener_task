<?php

declare(strict_types=1);

namespace App\Services\Links;

use App\Clients\Contracts\SafeUrlCheckContract;
use App\Exceptions\LinkUnsafeException;
use App\Models\Link;

class StoreLinkService
{
    public function __construct(
        private readonly SafeUrlCheckContract $urlCheckService,
        private readonly LinkHashService $linkHashService,
    ) {}

    /**
     * @throws LinkUnsafeException
     */
    public function store(string $url): Link
    {
        $link = Link::query()->where('url', $url)->first();

        if ($link) {
            return $link;
        }

        if (!$this->urlCheckService->isUrlSafe($url)) {
            throw new LinkUnsafeException('The provided URL is unsafe');
        }

        return Link::create([
            'hash' => $this->linkHashService->generateValidHash(),
            'url' => $url,
        ]);
    }
}
