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
    /**
     * @throws \Stichoza\JiraWebhooksData\Exceptions\JiraWebhookDataException
     */
    public function __invoke(Request $request): void
    {
        $webhook = new JiraWebhookData($request->all());

        Collection::make(Config::get('jira-webhooks.events'))
            ->filter(fn(string $event, string $key): bool => Str::is($key, $webhook->webhookEvent))
            ->each(fn($event) => Event::dispatch(new $event($webhook)));
    }
}
