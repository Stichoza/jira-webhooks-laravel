<?php

namespace Stichoza\JiraWebhooksLaravel;

use Illuminate\Support\ServiceProvider;

class JiraWebhooksLaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/jira-webhooks.php', 'jira-webhooks');
    }
}
