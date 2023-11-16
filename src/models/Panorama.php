<?php

class Panorama
{

    private string $id; // string ? int ?

    private string $name;

    private Map $map;

    private array $timelines = array(); // list de timeline, elle meme list de views

    private array $views = array();

    private function setId(string $id){
        $this->id = Utils::idGenerator($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getMap():Map
    {
        return $this->map;
    }

    public function setMap(Map $map)
    {
        $this->map = $map;
    }

    public function isMap():bool
    {
        return isset($this->map);
    }

    public function getTimelines()
    {
        return $this->timelines;
    }

    public function addTimeline($i,$timeline)
    {
        $this->timelines[$i] = $timeline;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function addView($i,$view)
    {
        $this->views[$i] = $view;
    }

    public function removeViewById($view)
    {
        array_splice($this->views, array_search($view, $this->views), 1);
    }

    public function __construct($name)
    {
        $this->name = $name;
        $this->setId($name);
        unset($this->map);
    }

}

?> 