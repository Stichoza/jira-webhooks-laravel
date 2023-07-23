<?php

namespace Stichoza\JiraWebhooksLaravel\Events;

use Stichoza\JiraWebhooksData\Models\JiraWebhookData;

class JiraWebhookReceived
{
    public function __construct(public JiraWebhookData $webhook) {}
}
