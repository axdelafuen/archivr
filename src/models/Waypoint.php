<?php

class Waypoint extends Element
{
    private View $destination;

    public function __construct($destination){
        $this->destination = $destination;
    }

    public function getDestination(): View{
        return $this->destination;
    }
}

?>