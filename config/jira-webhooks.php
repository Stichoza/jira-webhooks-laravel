<?php

return [

    /*
     * Event map between Jira and Laravel events.
     *
     * Keys are checked by `Str::is()` against `webhookEvent` sent by Jira. View full list of event names here:
     * https://developer.atlassian.com/server/jira/platform/webhooks/#configuring-a-webhook
     *
     * Events will receive `Stichoza\JiraWebhooksData\Models\JiraWebhookData` object.
     */
    'events' => [
        '*' => \Stichoza\JiraWebhooksLaravel\Events\JiraWebhookReceived::class,
        // 'jira:issue_created' => YourEvent::class,
        // 'jira:comment_*' => YourAnotherEvent::class,
    ],

];
