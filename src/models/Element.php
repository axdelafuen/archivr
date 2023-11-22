<?php

abstract class Element implements JsonSerializable
{
    protected string $id;

    protected Position $position;

    public function getId():string
    {
        return $this->id;
    }

    public function getPosition():Position
    {
        return $this->position;
    }

    public function setPosition(Position $position)
    {
        $this->position->setPosition($position->getX(), $position->getY(), $position->getZ());
    }

    public function setPositionXYZ($x, $y, $z)
    {
        $this->position->setPosition($x,$y,$z);
    }

    public function setPositionXY($x, $y)
    {
        $this->position->setX($x);
        $this->position->setY($y);
    }

    public function setPositionX(int $x)
    {
        $this->position->setX($x);
    }

    public function setPositionY($y)
    {
        $this->position->setY($y);
    }

    public function setPositionZ($z)
    {
        $this->position->setZ($z);
    }

    public function __construct($id)
    {
        $this->id = Utils::idGenerator($id);
        $this->position = new Position(0, 0, 0.1);
    }

    public function jsonSerialize():array{
        return get_object_vars($this);
    }
}

?>