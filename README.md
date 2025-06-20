Jira Webhooks Laravel
=====================

[![Latest Stable Version](https://img.shields.io/packagist/v/Stichoza/jira-webhooks-laravel.svg)](https://packagist.org/packages/stichoza/jira-webhooks-laravel) [![Total Downloads](https://img.shields.io/packagist/dt/Stichoza/jira-webhooks-laravel.svg)](https://packagist.org/packages/stichoza/jira-webhooks-laravel) [![Downloads Month](https://img.shields.io/packagist/dm/Stichoza/jira-webhooks-laravel.svg)](https://packagist.org/packages/stichoza/jira-webhooks-laravel) [![Petreon donation](https://img.shields.io/badge/patreon-donate-orange.svg)](https://www.patreon.com/stichoza) [![PayPal donation](https://img.shields.io/badge/paypal-donate-blue.svg)](https://paypal.me/stichoza)

Laravel package for interacting with Jira Webhooks.

## Installation

Install this package via Composer:

```bash
composer require stichoza/jira-webhooks-laravel
```

This package uses Laravel's package auto-discovery, so you don't have to manually add the service provider.

### Laravel Without Auto-discovery
If you don't use auto-discovery, add the ServiceProvider to the providers array in `config/app.php`

```php
Stichoza\JiraWebhooksLaravel\JiraWebhooksLaravelServiceProvider::class,
```

If you want to use facade for routes, add this to aliases in you `config/app.php`

```php
'JiraWebhooks' => Stichoza\JiraWebhooksLaravel\JiraWebhooks::class,
```

### Export Configuration Files

_(Optional)_ If you want to customize events dispatched by the package, copy the package config to your local config with the publish command:

```bash
php artisan vendor:publish --provider="Stichoza\JiraWebhooksLaravel\JiraWebhooksLaravelServiceProvider" --tag=config
```

### Add Webhook Route

You can add webhook route to your routes file using `JiraWebhooks` class:

```php
JiraWebhooks::route();
```

This will create a POST route with URI `jira-webhook`. You can also customize the URI of the route by passing a parameter. This method returns `Illuminate\Routing\Route` object, so you can use all other methods available on regular routes.

```php
JiraWebhooks::route('jira/my_webhook')->middleware(SomeMiddleware::class);
```

### CSRF Protection

If you're adding the route to your web routes, make sure you disable the CSRF middleware for the webhook route. Do this by adding URI to `$except` property of `VerifyCsrfToken` middleware.

```php
protected $except = [
    // ...
    'jira-webhook', // or the custom URI you passed to `JiraWebhooks::route()`
];
```
## Usage

By default, the package will dispatch `Stichoza\JiraWebhooksLaravel\Events\JiraWebhookReceived` event for any incoming webhook along with a specific event depending on the `webhookEvent` of webhook received.

### Using Events

Here is the table of Jira `webhookEvent` event names and respective events dispatched by this package:

| Jira event name                  | Event dispatched by this package           |
|----------------------------------|--------------------------------------------|
| * (any webhook)                  | `JiraWebhookReceived`                      |
| jira:issue_created               | `JiraWebhookJiraIssueCreated`              |
| jira:issue_updated               | `JiraWebhookJiraIssueUpdated`              |
| jira:issue_deleted               | `JiraWebhookJiraIssueDeleted`              |
| jira:worklog_updated             | `JiraWebhookJiraWorklogUpdated`            |
| issuelink_created                | `JiraWebhookIssueLinkCreated`              |
| issuelink_deleted                | `JiraWebhookIssueLinkDeleted`              |
| worklog_created                  | `JiraWebhookWorklogCreated`                |
| worklog_updated                  | `JiraWebhookWorklogUpdated`                |
| worklog_deleted                  | `JiraWebhookWorklogDeleted`                |
| comment_created                  | `JiraWebhookCommentCreated`                |
| comment_updated                  | `JiraWebhookCommentUpdated`                |
| comment_deleted                  | `JiraWebhookCommentDeleted`                |
| project_created                  | `JiraWebhookProjectCreated`                |
| project_updated                  | `JiraWebhookProjectUpdated`                |
| project_deleted                  | `JiraWebhookProjectDeleted`                |
| jira:version_released            | `JiraWebhookJiraVersionReleased`           |
| jira:version_unreleased          | `JiraWebhookJiraVersionUnreleased`         |
| jira:version_created             | `JiraWebhookJiraVersionCreated`            |
| jira:version_moved               | `JiraWebhookJiraVersionMoved`              |
| jira:version_updated             | `JiraWebhookJiraVersionUpdated`            |
| jira:version_deleted             | `JiraWebhookJiraVersionDeleted`            |
| user_created                     | `JiraWebhookUserCreated`                   |
| user_updated                     | `JiraWebhookUserUpdated`                   |
| user_deleted                     | `JiraWebhookUserDeleted`                   |
| option_voting_changed            | `JiraWebhookOptionVotingChanged`           |
| option_watching_changed          | `JiraWebhookOptionWatchingChanged`         |
| option_unassigned_issues_changed | `JiraWebhookOptionUnassignedIssuesChanged` |
| option_subtasks_changed          | `JiraWebhookOptionSubtasksChanged`         |
| option_attachments_changed       | `JiraWebhookOptionAttachmentsChanged`      |
| option_issuelinks_changed        | `JiraWebhookOptionIssueLinksChanged`       |
| option_timetracking_changed      | `JiraWebhookOptionTimeTrackingChanged`     |
| sprint_created                   | `JiraWebhookSprintCreated`                 |
| sprint_deleted                   | `JiraWebhookSprintDeleted`                 |
| sprint_updated                   | `JiraWebhookSprintUpdated`                 |
| sprint_started                   | `JiraWebhookSprintStarted`                 |
| sprint_closed                    | `JiraWebhookSprintClosed`                  |
| board_created                    | `JiraWebhookBoardCreated`                  |
| board_updated                    | `JiraWebhookBoardUpdated`                  |
| board_deleted                    | `JiraWebhookBoardDeleted`                  |
| board_configuration_changed      | `JiraWebhookBoardConfigurationChanged`     |

> [!Note]
> Default events are in `Stichoza\JiraWebhooksLaravel\Events` namespace.

### Defining Custom Events

You can extend or customize event map by adding different events in `config/jira-webhooks.php` file. These are regular events that you can create by `php artisan make:event` command.

```php
'events' => [
    // '*' => \Stichoza\JiraWebhooksLaravel\Events\JiraWebhookReceived::class,
    'jira:issue_created' => \App\Events\JiraIssueCreated::class,
    'jira:issue_updated' => \App\Events\JiraIssueUpdated::class,
    'comment_created' => \App\Events\JiraCommentCreated::class,
    'issuelink_*' => \App\Events\JiraIssueLinkCreatedOrDeleted::class,
    // ...
],
```

All events will receive the `Stichoza\JiraWebhooksData\Models\JiraWebhookData` object in the constructor.

The keys are checked against Jira's webhook event name (webhookEvent property)  using `Str::is()` method, so you can use wildcards in names. You can find the full list of [Jira webhook event names here](https://developer.atlassian.com/server/jira/platform/webhooks/#registering-events-for-a-webhook).

> [!Important]
> All events matching the pattern will be triggered, not just the first one.

### Handling Events

You should define the listeners for the events that you configured in `config/jira-webhooks.php` file. You can create listeners using Laravel's `php artisan make:listener` command.

All events will have a `webhook` property of type `Stichoza\JiraWebhooksData\Models\JiraWebhookData`. This object contains all data from webhook request. Read more about these data structures in the readme of [stichoza/jira-webhooks-data](https://github.com/Stichoza/jira-webhooks-data) package.

## Example

```php
<?php

namespace App\Listeners;

use App\Events\JiraCommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JiraCommentCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(JiraCommentCreated $event): void
    {
        $title = 'New comment by ' . $event->webhook->comment->author->displayName
            . ' on issue ' . $event->webhook->issue->key;

        $message = $event->webhook->comment->author->displayName
            . ' said: ' . $event->webhook->comment->body;

        // Do something else
    }
}
```

## Recommendations

It's recommended to make listeners queued. This package returns `200 OK` response to Jira, so if the response will take too much time, Jira will assume that webhook delivery failed.
