<?php

namespace Fahrplan\Models\Transport;

use Fahrplan\Models\ActiveRecordEntity;

class Transport extends ActiveRecordEntity
{

    /** @var string */
    protected $name;

    /** @var string */
    protected $stops;

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->stops;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setText(string $text): void
    {
        $this->stops = $text;
    }

    public function setId(string $id):void
    {
        $this->id = $id;
    }

    protected static function getTableName(): string
    {
        return 'main';
    }
}