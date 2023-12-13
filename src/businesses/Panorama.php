<?php

class Panorama implements JsonSerializable
{

    private string $id;

    private string $name;

    private Map $map;

    private array $timelines = array();

    private array $views = array();

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
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
        foreach ($this->getTimelines() as $timeline) {
            if ($timeline->getId() === $id) {
                return $timeline;
            }
        }
        return null;
    }

    public function removeTimeline($timeline)
    {
        array_splice($this->timelines, array_search($timeline, $this->timelines), 1);
    }

    public function getViews(): array
    {
        return $this->views;
    }

    public function getViewByPath($path)
    {
        foreach ($this->getViews() as $view) {
            if ($view->getPath() === $path) {
                return $view;
            }
        }
        return null;
    }

    public function isView(View $value): bool
    {
        if (in_array($value, $this->views)) {
            return true;
        }
        return false;
    }

    public function addView($i, $view)
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

    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }

    public function setViews(array $views)
    {
        $this->views = $views;
    }

    public function setTimelines(array $timelines)
    {
        $this->timelines = $timelines;
    }

    public function set($data)
    {
        $this->id = $data;
    }

    public function removeEveryWaypointTo($destination):void
    {
        foreach ($this->views as $view) {
            foreach ($view->getElements() as $element) {
                if (get_class($element) == "Waypoint") {
                    if ($element->getView() == $destination) {
                        $view->removeElement($element);
                    }
                }
            }
        }

        foreach ($this->timelines as $timeline) {
            foreach ($timeline->getViews() as $view) {
                foreach ($view->getElements() as $element) {
                    if (get_class($element) == "Waypoint") {
                        if ($element->getView() == $destination) {
                            $view->removeElement($element);
                        }
                    }
                }
            }
        }
    }
}
