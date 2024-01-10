<?php

namespace App\Clients;

use App\Clients\Contracts\SafeUrlCheckContract;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class GoogleSafeSearchClient implements SafeUrlCheckContract
{
    private string $apiKey;
    private string $clientId;
    private readonly PendingRequest $httpClient;

    public function __construct()
    {
        $this->apiKey = config('services.google_safe_browsing.key');
        $this->clientId = config('services.google_safe_browsing.client');

        $this->httpClient = Http::baseUrl(config('services.google_safe_browsing.url'))
            ->contentType('application/json')
            ->acceptJson();
    }

    /**
     * @throws RequestException
     */
    public function isUrlSafe(string $url): bool
    {
        $payload = [
            'client' => [
                'clientId' => $this->clientId,
                'clientVersion' => '1.5.2',
            ],
            'threatInfo' => [
                'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                'platformTypes' => ['WINDOWS'],
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    ['url' => $url],
                ],
            ],
        ];

        $response = $this->httpClient->post(
            url: 'threatMatches:find?key='.$this->apiKey,
            data: $payload
        );

        $response->throw();

        return empty($response->json('matches', []));
    }
}
