<?php

class Waypoint extends Element implements JsonSerializable
{
    private View $destination;

    private float $scale;

    public function getScale():string{
        return $this->scale . " " . $this->scale . " " . $this->scale;
    }

    public function setScale($scale):void{
        $this->scale = $scale;
    }

    public function getScaleInt(){
        return $this->scale;
    }

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
        $this->scale = 1;
    }

    public function jsonSerialize():array {
        $out = parent::jsonSerialize();
        $out["scale"] = $this->scale;
        $out["destination"] = $this->getView()->getPath();

        return $out;
    }

    public function set($data) {
        $this->scale = $data['scale'];
        parent::set($data);
    }
}

?>