<?php

abstract class Image
{
    protected string $id;

    protected string $path;

    protected array $elements; // list of elements

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }

}

?>