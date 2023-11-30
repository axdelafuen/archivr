<?php

class View extends Image implements JsonSerializable
{
    private int $date;

    private Rotation $cameraRotation;

    public function isDate():bool
    {
        return isset($this->date);
    }

    public function getDate():int
    {
        return $this->date;
    }

    public function setDate(int $date)
    {
        $this->date = $date;
    }

    public function getCameraRotation():Rotation
    {
        return $this->cameraRotation;
    }

    public function setCameraRotation(float $x, float $y, float $z)
    {
        $this->cameraRotation->setX($x);
        $this->cameraRotation->setY($y);
        $this->cameraRotation->setZ($z);
    }

    public function __construct($path)
    {
        parent::__construct($path);
        $this->cameraRotation = new Rotation(0,0,0);
    }

    public function jsonSerialize():array{
        return get_object_vars($this);
    }

    public function set($data){
        parent::set($data);
    }
}

?>