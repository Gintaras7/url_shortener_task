<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\LinkUnsafeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLinkRequest;
use App\Http\Resources\Api\LinkResource;
use App\Services\Links\StoreLinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class LinkController extends Controller
{
    public function __construct(
        private readonly StoreLinkService $linkService
    ) {}

    public function storeLink(StoreLinkRequest $request): JsonResponse
    {
        try {
            $link = $this->linkService->store($request->validated('url'));

            return response()->json(
                data: new LinkResource($link),
                status: $link->wasRecentlyCreated ? Response::HTTP_CREATED : Response::HTTP_OK
            );
        } catch (LinkUnsafeException $e) {
            Log::debug('URL is unsafe', ['payload' => $request->toArray()]);

            abort(Response::HTTP_BAD_REQUEST, 'URL is unsafe');
        } catch (Throwable $e) {
            Log::error('Unexpected error', [
                'payload' => $request->toArray(),
                'exception' => $e,
            ]);

            abort(Response::HTTP_BAD_REQUEST, 'Something went wrong. Please try again later');
        }
    }
}
