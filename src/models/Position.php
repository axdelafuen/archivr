<?php

class Position
{
    private int $x;

    private int $y;

    private int $z;

    public function getPosition(): string
    {
        return "$this->x " . "$this->y " . "$this->z";
    }

    public function setPosition($x, $y, $z)
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

    public function getX():int
    {
        return $this->x;
    }

    public function getY():int
    {
        return $this->y;
    }

    public function getZ():int
    {
        return $this->z;
    }

    public function __construct($x = 0, $y = 0, $z = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }


    public function __toString(): string{
        return "$this->x " . "$this->y " . "$this->z";
    }
}

?>