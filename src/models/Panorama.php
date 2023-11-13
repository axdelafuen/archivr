<?php

class Panorama
{

    private string $id; // string ? int ?

    private Map $map;

    private array $timelines = array(); // list de timeline, elle meme list de views

    private array $views = array();

    public function setId(string $id){
        $this->id = Utils::idGenerator($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMap():Map
    {
        return $this->map;
    }

    public function setMap(Map $map)
    {
        $this->map = $map;
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

    public function __construct()
    {
    }

}

?> 