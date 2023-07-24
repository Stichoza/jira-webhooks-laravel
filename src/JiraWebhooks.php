<?php

namespace Stichoza\JiraWebhooksLaravel;

use Illuminate\Support\Facades\Route;
use Stichoza\JiraWebhooksLaravel\Http\Controllers\JiraWebhookController;

class JiraWebhooks
{
    public static function route(string $uri = 'jira-webhook'): \Illuminate\Routing\Route
    {
        return Route::post($uri, JiraWebhookController::class);
    }
}
