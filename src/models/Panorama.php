<?php

class Panorama implements JsonSerializable
{

    private string $id; // string ? int ?

    private string $name;

    private Map $map;

    private array $timelines = array(); // list de timeline, elle meme list de views

    private array $views = array();

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

    public function getTimelines():array
    {
        return $this->timelines;
    }

    public function addTimeline($timeline)
    {
        $this->timelines[] = $timeline;
    }

    public function getTimelineById($id)
    {
        foreach($this->getTimelines() as $timeline)
        {
            if($timeline->getId() === $id)
            {
                return $timeline;
            }
        }
        return null;
    }

    public function removeTimeline($timeline)
    {
        array_splice($this->timelines, array_search($timeline, $this->timelines), 1);
    }

    public function getViews()
    {
        return $this->views;
    }

    public function getViewByPath($path)
    {
        foreach($this->getViews() as $view)
        {
            if($view->getPath() === $path)
            {
                return $view;
            }
        }
        return null;
    }

    public function isView(View $value)
    {
        foreach ($this->views as $view) {
            if($view == $value){
                return true;
            }
        }
        return false;
    }

    public function addView($i,$view)
    {
        $this->views[$i] = $view;
    }

    public function removeView($view)
    {
        array_splice($this->views, array_search($view, $this->views), 1);
    }

    public function removeMap()
    {
        unset($this->map);
    }

    public function __construct($name)
    {
        $this->name = $name;
        $this->id = Utils::idGenerator($name);
        unset($this->map);
    }

    public function jsonSerialize():array{
        return get_object_vars($this);
    }

    public function setViews(array $views){
        $this->views = $views;
    }

    public function setTimelines(array $timelines){
        $this->timelines = $timelines;
    }

    public function set($data) {
        $this->id = $data;
    }
}