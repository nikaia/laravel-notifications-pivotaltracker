<?php

namespace NotificationChannels\PivotalTracker\Exceptions;

class CouldNotCreateMessage extends \Exception
{
    public static function invalidStoryType($type)
    {
        return new static("Story type `{$type}` is invalid. It should be feature, bug or chore");
    }
}
