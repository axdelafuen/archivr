<?php

class Rotation implements JsonSerializable {

    private float $x;

    private float $y;

    private float $z;

    public function getRotation(): string
    {
        return "$this->x " . "$this->y " . "$this->z";
    }

    public function setRotation($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function setZ($z)
    {
        $this->z = $z;
    }

    public function getX():float
    {
        return $this->x;
    }

    public function getY():float
    {
        return $this->y;
    }

    public function getZ():float
    {
        return $this->z;
    }

    public function __construct($x = 0, $y = 180, $z = 0)
    {
        $this->setRotation($x, $y, $z);
    }

    public function __toString(): string
    {
        return "$this->x " . "$this->y " . "$this->z";
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
