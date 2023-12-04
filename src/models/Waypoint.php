<?php

class Waypoint extends Element implements JsonSerializable
{
    private $destination;

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

    public function __construct($destination)
    {
        if(get_class($destination) == View::class){
            parent::__construct($destination->getPath());
        } else {
            parent::__construct($destination->getName());
        }
        
        if(get_class($destination) != "View" and get_class($destination) != "Timeline"){
            // to handle
            return null;
        }
        $this->destination = $destination;
        $this->scale = 1;
    }

    public function jsonSerialize():array {
        $out = parent::jsonSerialize();
        $out["scale"] = $this->scale;
        if(get_class($this->destination) == "View"){
            $out["destination"] = $this->getView()->getPath();
        }else{
            $out["destination"] = $this->getView()->getName();
        }

        return $out;
    }

    public function set($data) {
        $this->scale = $data['scale'];
        parent::set($data);
    }
}