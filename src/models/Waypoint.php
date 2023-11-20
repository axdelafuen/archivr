<?php

class Waypoint extends Element
{
    private View $destination;

    public function getView()
    {
        return $this->destination;
    }

    public function getViewName()
    {
        return $this->destination->getName();
    }

    public function __construct(View $destination)
    {
        parent::__construct($destination->getName());
        $this->destination = $destination;
    }

}

?>