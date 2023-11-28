<?php

class View extends Image implements JsonSerializable
{
    protected int $date;

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

    public function __construct($path)
    {
        parent::__construct($path);
    }

    public function jsonSerialize():array{
        return get_object_vars($this);
    }

    public function set($data){
        parent::set($data);
    }
}

?>