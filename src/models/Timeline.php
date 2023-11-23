<?php

class Timeline
{

    private string $id; // string ? int ?

    private string $name;

    private array $views;

    public function getViews()
    {
        return $this->views;
    }

    public function addView(View $view)
    {
        $this->views[] = $view;
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

}

?>