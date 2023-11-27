<?php

class Timeline
{

    private string $id; // string ? int ?

    private string $name;

    private array $views = array();

    public function getViews()
    {
        return $this->views;
    }

    public function getFirstView()
    {
        if(count($this->views) > 0){
            return $this->views[0];
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

    public function addView(View $view)
    {
        $this->views[] = $view;
    }

    public function removeView($view)
    {
        array_splice($this->views, array_search($view, $this->views), 1);
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

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
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