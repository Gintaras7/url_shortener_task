<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;

class PageController
{
    public function show(string $hash): RedirectResponse
    {
        $link = Link::where('hash', $hash)->firstOrFail();

        return redirect()->away($link->url);
    }
}
