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

    public function __construct($destination)
    {
        parent::__construct();
        $this->destination = $destination;
    }

}

?>