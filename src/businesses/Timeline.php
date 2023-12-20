<?php

class Timeline implements JsonSerializable
{

    private string $id;

    private string $name;

    private array $views = array();

    public function getViews():array
    {
        return $this->views;
    }

    public function setViews(array $views)
    {
        $this->views = $views;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getId():string
    {
        return $this->id;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->id = Utils::idGenerator($name);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function set(View $view)
    {
        $this->views[] = $view;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
