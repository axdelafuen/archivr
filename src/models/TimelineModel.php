<?php

class TimelineModel
{
    private Timeline $timeline;

    public function __construct(Timeline $timeline)
    {
        $this->timeline = $timeline;
    }

    public function getFirstView():?View
    {
        if (count($this->timeline->getViews()) > 0) {
            return $this->timeline->getViews()[0];
        }
        return null;
    }

    public function isView(View $value):bool
    {
        if (in_array($value, $this->timeline->getViews())) {
            return true;
        }
        return false;
    }

    public function addView(View $view)
    {
        $array = $this->timeline->getViews();
        $array[] = $view;
        $this->timeline->setViews($array);
    }

    public function removeView($view)
    {
        $array = $this->timeline->getViews();
        array_splice($array, array_search($view, $array), 1);
        $this->timeline->setViews($array);
    }

    public function getViewByPath($path):?View
    {
        foreach ($this->timeline->getViews() as $view) {
            if ($view->getPath() === $path) {
                return $view;
            }
        }
        return null;
    }
}
