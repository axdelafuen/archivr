<?php

abstract class Element
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

    public function __construct()
    {
        $this->id = Utils::idGenerator("");
        $this->position = new Position(6, 0, -10);
    }

}

?>