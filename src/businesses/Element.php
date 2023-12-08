<?php

abstract class Element implements JsonSerializable
{
    protected string $id;

    protected Position $position;

    protected Rotation $rotation;

    public function getId():string
    {
        return $this->id;
    }

    public function getPosition():Position
    {
        return $this->position;
    }

    public function getRotation():Rotation
    {
        return $this->rotation;
    }

    public function setRotation(Rotation $rotation)
    {
        $this->rotation->setRotation($rotation->getX(), $rotation->getY(), $rotation->getZ());
    }

    public function setPosition(Position $position)
    {
        $this->position->setPosition($position->getX(), $position->getY(), $position->getZ());
    }

    public function setPositionXYZ($x, $y, $z)
    {
        $this->position->setPosition($x, $y, $z);
    }

    public function setPositionXY($x, $y)
    {
        $this->position->setX($x);
        $this->position->setY($y);
    }

    public function setRotationXYZ($x, $y, $z)
    {
        $this->rotation->setRotation($x, $y, $z);
    }

    public function setRotationX($x)
    {
        $this->rotation->setX($x);
    }

    public function setRotationY($y)
    {
        $this->rotation->setY($y);
    }

    public function setRotationZ($z)
    {
        $this->rotation->setZ($z);
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
        $this->rotation = new Rotation();
    }

    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }

    public function set($data)
    {
        $position = new Position();
        $rotation = new Rotation();

        $rotation->setRotation($data['rotation']['x'], $data['rotation']['y'], $data['rotation']['z']);
        $position->setPosition($data['position']['x'], $data['position']['y'], $data['position']['z']);

        $this->setPosition($position);
        $this->setRotation($rotation);

        $this->id = $data['id'];
    }
}
