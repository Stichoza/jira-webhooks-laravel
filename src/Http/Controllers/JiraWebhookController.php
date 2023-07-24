<?php

namespace Stichoza\JiraWebhooksLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Stichoza\JiraWebhooksData\Models\JiraWebhookData;

class JiraWebhookController extends Controller
{
    public function __invoke(Request $request): void
    {
        $webhook = JiraWebhookData::parse($request->all());

        Collection::make(Config::get('jira-webhooks.events'))
            ->filter(fn(string $event, string $key): bool => Str::is($key, $webhook->getWebhookEvent()))
            ->each(fn($event) => Event::dispatch(new $event($webhook)));
    }
}
