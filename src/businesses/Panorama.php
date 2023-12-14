<?php

class Panorama implements JsonSerializable
{

    private string $id;

    private string $name;

    private ?Map $map = null;

    private array $timelines = array();

    private array $views = array();

    public function getId(): string
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getMap():?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map)
    {
        $this->map = $map;
    }

    public function getTimelines():array
    {
        return $this->timelines;
    }

    public function setTimelines(array $timelines)
    {
        $this->timelines = $timelines;
    }

    public function getViews(): array
    {
        return $this->views;
    }

    public function setViews(array $views)
    {
        $this->views = $views;
    }

    public function __construct($name)
    {
        $this->name = $name;
        $this->id = Utils::idGenerator($name);
    }

    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }
}
