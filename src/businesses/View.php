<?php

class View extends Image implements JsonSerializable
{
    private ?int $date = null;

    private Rotation $cameraRotation;
    public function getDate():?int
    {
        return $this->date;
    }

    public function setDate(?int $date)
    {
        $this->date = $date;
    }

    public function getCameraRotation():Rotation
    {
        return $this->cameraRotation;
    }

    public function setCameraRotation(float $y)
    {
        $this->cameraRotation->setY($y);
    }

    public function __construct($path)
    {
        parent::__construct($path);
        $this->cameraRotation = new Rotation(0, 0, 0);
    }

    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }

}
