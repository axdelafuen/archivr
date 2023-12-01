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
        if(isset($destination['is_view'])){
            parent::__construct($destination['object']->getPath());
        } else {
            parent::__construct($destination['object']->getName());
        }
        
        if(get_class($destination['object']) != "View" and get_class($destination['object']) != "Timeline"){
            // to handle
            return null;
        }
        $this->destination = $destination['object'];
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

?>