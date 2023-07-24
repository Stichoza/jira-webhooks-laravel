<?php

namespace Stichoza\JiraWebhooksLaravel;

use Illuminate\Support\ServiceProvider;

class JiraWebhooksLaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/jira-webhooks.php' => config_path('jira-webhooks.php'),
        ], 'jira-webhooks-config');

        $this->mergeConfigFrom(__DIR__ . '/../config/jira-webhooks.php', 'jira-webhooks');
    }
}
