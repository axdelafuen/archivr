<?php

class PanoramaModel{

    private Panorama $panorama;

    public function __construct(Panorama $panorama)
    {
        $this->panorama = $panorama;
    }

    public function addTimeline($timeline)
    {
        $array = $this->panorama->getTimelines();
        $array[] = $timeline;
        $this->panorama->setTimelines($array);
    }

    public function removeTimeline($timeline)
    {
        $array = $this->panorama->getTimelines();
        array_splice($array, array_search($timeline, $array), 1);
        $this->panorama->setTimelines($array);
    }

    public function isView(View $value): bool
    {
        if (in_array($value, $this->panorama->getViews())) {
            return true;
        }
        return false;
    }

    public function addView($view)
    {
        $array = $this->panorama->getViews();
        $array[] = $view;
        $this->panorama->setViews($array);
    }

    public function removeView($view)
    {
        $array = $this->panorama->getViews();
        array_splice($array, array_search($view, $array), 1);
        $this->panorama->setViews($array);
    }

    public function removeMap()
    {
        $this->panorama->setMap(null);
    }

    public function getViewByPath($path):?View
    {
        foreach ($this->panorama->getViews() as $view) {
            if ($view->getPath() === $path) {
                return $view;
            }
        }
        return null;
    }

    public function getTimelineById($id):?Timeline
    {
        foreach ($this->panorama->getTimelines() as $timeline) {
            if ($timeline->getId() === $id) {
                return $timeline;
            }
        }
        return null;
    }

    public function removeEveryWaypointTo($destination):void
    {
        foreach ($this->panorama->getViews() as $view) {
            foreach ($view->getElements() as $element) {
                if (get_class($element) == "Waypoint") {
                    if ($element->getView() == $destination) {
                        $imageMdl = new ImageModel($view);
                        $imageMdl->removeElement($element);
                    }
                }
            }
        }

        foreach ($this->panorama->getTimelines() as $timeline) {
            foreach ($timeline->getViews() as $view) {
                foreach ($view->getElements() as $element) {
                    if (get_class($element) == "Waypoint") {
                        if ($element->getView() == $destination) {
                            $imageMdl = new ImageModel($view);
                            $imageMdl->removeElement($element);
                        }
                    }
                }
            }
        }
    }
}
