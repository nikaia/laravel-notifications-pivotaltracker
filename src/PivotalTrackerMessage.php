<?php

namespace NotificationChannels\PivotalTracker;


use NotificationChannels\PivotalTracker\Exceptions\CouldNotCreateMessage;

class PivotalTrackerMessage
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /** @var string */
    protected $type = 'chore';

    /** @var array list of labels (strings list) */
    protected $labels = [];

    /**
     * @param string $name
     *
     * @return static
     */
    public static function create($name = '')
    {
        return new static($name);
    }

    /**
     * @param string $name
     */
    public function __construct($name = '')
    {
        $this->name = $name;
    }

    /**
     * Set the story name.
     *
     * @param $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the story description.
     *
     * @param $description
     *
     * @return $this
     */
    public function description($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the story type.
     *
     * @param string $type
     *
     * @return $this
     *
     * @throws CouldNotCreateMessage
     */
    public function type($type)
    {
        if (!StoryType::isValid($type)) {
            throw CouldNotCreateMessage::invalidStoryType($type);
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Set the story labels.
     *
     * @param array|mixed
     *
     * @return $this
     *
     * @throws CouldNotCreateMessage
     */
    public function labels($labels)
    {
        $this->labels = is_array($labels) ? $labels : func_get_args();;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'story_type' => $this->type,
            'labels' => $this->labels,
        ];
    }
}
