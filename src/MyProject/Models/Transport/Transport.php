<?php

namespace MyProject\Models\Transport;

use MyProject\Models\ActiveRecordEntity;

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

    protected static function getTableName(): string
    {
        return 'main';
    }
}