<?php

class View extends Image implements JsonSerializable
{
    protected DateTime $date;

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