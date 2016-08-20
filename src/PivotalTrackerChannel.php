<?php

namespace NotificationChannels\PivotalTracker;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use NotificationChannels\PivotalTracker\Exceptions\CouldNotSendNotification;

class PivotalTrackerChannel
{
    const API_ENDPOINT = 'https://www.pivotaltracker.com/services/v5/';

    /** @var Client */
    protected $client;

    /** @param Client $client */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\PivotalTracker\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$routing = collect($notifiable->routeNotificationFor('PivotalTracker'))) {
            return;
        }

        $parameters = $notification->toPivotalTracker($notifiable)->toArray();

        $response = $this->client->request('POST', $this->storiesEndpoint($routing->get('projectId')), [
            'headers' => [
                'X-TrackerToken' => $routing->get('token'),
                'Content-Type' => 'application/json',
            ],
            'json' => $parameters,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }

    /**
     * Return the stories api endpoint for a given project.
     *
     * @param int $projectId the projet identifier
     *
     * @return string the stories endpoint
     */
    protected function storiesEndpoint($projectId)
    {
        return self::API_ENDPOINT . "projects/{$projectId}/stories";
    }
}
