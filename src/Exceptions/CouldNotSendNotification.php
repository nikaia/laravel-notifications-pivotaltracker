<?php

namespace NotificationChannels\PivotalTracker\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('Pivotal Tracker responded with an error: `' . $response->getBody()->getContents() . '`');
    }
}
