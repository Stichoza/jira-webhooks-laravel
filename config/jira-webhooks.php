<?php

use Stichoza\JiraWebhooksLaravel\Events;

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
        '*' => Events\JiraWebhookReceived::class,
        'jira:issue_created' => Events\JiraWebhookJiraIssueCreated::class,
        'jira:issue_updated' => Events\JiraWebhookJiraIssueUpdated::class,
        'jira:issue_deleted' => Events\JiraWebhookJiraIssueDeleted::class,
        'jira:worklog_updated' => Events\JiraWebhookJiraWorklogUpdated::class,
        'issuelink_created' => Events\JiraWebhookIssuelinkCreated::class,
        'issuelink_deleted' => Events\JiraWebhookIssuelinkDeleted::class,
        'worklog_created' => Events\JiraWebhookWorklogCreated::class,
        'worklog_updated' => Events\JiraWebhookWorklogUpdated::class,
        'worklog_deleted' => Events\JiraWebhookWorklogDeleted::class,
        'comment_created' => Events\JiraWebhookCommentCreated::class,
        'comment_updated' => Events\JiraWebhookCommentUpdated::class,
        'comment_deleted' => Events\JiraWebhookCommentDeleted::class,
        'project_created' => Events\JiraWebhookProjectCreated::class,
        'project_updated' => Events\JiraWebhookProjectUpdated::class,
        'project_deleted' => Events\JiraWebhookProjectDeleted::class,
        'jira:version_released' => Events\JiraWebhookJiraVersionReleased::class,
        'jira:version_unreleased' => Events\JiraWebhookJiraVersionUnreleased::class,
        'jira:version_created' => Events\JiraWebhookJiraVersionCreated::class,
        'jira:version_moved' => Events\JiraWebhookJiraVersionMoved::class,
        'jira:version_updated' => Events\JiraWebhookJiraVersionUpdated::class,
        'jira:version_deleted' => Events\JiraWebhookJiraVersionDeleted::class,
        'user_created' => Events\JiraWebhookUserCreated::class,
        'user_updated' => Events\JiraWebhookUserUpdated::class,
        'user_deleted' => Events\JiraWebhookUserDeleted::class,
        'option_voting_changed' => Events\JiraWebhookOptionVotingChanged::class,
        'option_watching_changed' => Events\JiraWebhookOptionWatchingChanged::class,
        'option_unassigned_issues_changed' => Events\JiraWebhookOptionUnassignedIssuesChanged::class,
        'option_subtasks_changed' => Events\JiraWebhookOptionSubtasksChanged::class,
        'option_attachments_changed' => Events\JiraWebhookOptionAttachmentsChanged::class,
        'option_issuelinks_changed' => Events\JiraWebhookOptionIssuelinksChanged::class,
        'option_timetracking_changed' => Events\JiraWebhookOptionTimetrackingChanged::class,
        'sprint_created' => Events\JiraWebhookSprintCreated::class,
        'sprint_deleted' => Events\JiraWebhookSprintDeleted::class,
        'sprint_updated' => Events\JiraWebhookSprintUpdated::class,
        'sprint_started' => Events\JiraWebhookSprintStarted::class,
        'sprint_closed' => Events\JiraWebhookSprintClosed::class,
        'board_created' => Events\JiraWebhookBoardCreated::class,
        'board_updated' => Events\JiraWebhookBoardUpdated::class,
        'board_deleted' => Events\JiraWebhookBoardDeleted::class,
        'board_configuration_changed' => Events\JiraWebhookBoardConfigurationChanged::class,
    ],

];
