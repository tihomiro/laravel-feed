<?php

namespace Spatie\Feed;

use Exception;
use Carbon\Carbon;
use Spatie\Feed\Exceptions\InvalidFeedItem;

class FeedItem
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $lead;

    /** @var string */
    protected $m4a;

    /** @var string */
    protected $duration;

    /** @var string */
    protected $keywords;

    /** @var string */
    protected $enclosure;

    /** @var string */
    protected $title;

    /** @var \Carbon\Carbon */
    protected $updated;

    /** @var string */
    protected $summary;

    /** @var @var string */
    protected $link;

    /** @var string */
    protected $author;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function create(array $data = [])
    {
        return new static($data);
    }

    public function id(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function lead(string $lead)
    {
        $this->lead = $lead;

        return $this;
    }

    public function m4a(string $m4a)
    {
        $this->m4a = $m4a;

        return $this;
    }

    public function duration(string $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    public function keywords(string $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function enclosure(string $enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function updated(Carbon $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function summary(string $summary)
    {
        $this->summary = $summary;

        return $this;
    }

    public function link(string $link)
    {
        $this->link = $link;

        return $this;
    }

    public function author(string $author)
    {
        $this->author = $author;

        return $this;
    }

    public function validate()
    {
        $requiredFields = ['id', 'title', 'updated', 'summary', 'link', 'author'];

        foreach ($requiredFields as $requiredField) {
            if (is_null($this->$requiredField)) {
                throw InvalidFeedItem::missingField($this, $requiredField);
            }
        }
    }

    public function __get($key)
    {
        if (! isset($this->$key)) {
            throw new Exception("Property `{$key}` doesn't exist");
        }

        return $this->$key;
    }
}
