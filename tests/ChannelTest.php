<?php

namespace NotificationChannels\PivotalTracker\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Notifications\Notification;
use Mockery;
use NotificationChannels\PivotalTracker\Exceptions\CouldNotSendNotification;
use NotificationChannels\PivotalTracker\PivotalTrackerChannel;
use NotificationChannels\PivotalTracker\PivotalTrackerMessage;
use Orchestra\Testbench\TestCase;

class ChannelTest extends TestCase
{
    /** @test */
    function it_can_send_a_notification()
    {
        $response = new Response(200);

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')
            ->once()
            ->with('POST', 'https://www.pivotaltracker.com/services/v5/projects/ProjectId/stories',
                [
                    'headers' => [
                        'X-TrackerToken' => 'NotifiableToken',
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'name' => 'Story name',
                        'description' => 'Story description',
                        'story_type' => 'bug',
                        'labels' => ['bug', 'env-production'],
                    ],
                ])
            ->andReturn($response);

        $channel = new PivotalTrackerChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    function it_throws_an_exception_when_it_could_not_send_the_notification()
    {
        $this->setExpectedException(CouldNotSendNotification::class);

        $response = new Response(500);

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')
            ->once()
            ->andReturn($response);

        $channel = new PivotalTrackerChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }
}

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    public function routeNotificationForPivotalTracker()
    {
        return [
            'token' => 'NotifiableToken',
            'projectId' => 'ProjectId',
        ];
    }
}

class TestNotification extends Notification
{
    public function toPivotalTracker($notifiable)
    {
        return
            (new PivotalTrackerMessage('Story name'))
                ->description('Story description')
                ->type('bug')
                ->labels(['bug', 'env-production']);
    }
}
