<?php

class AssetImported extends Element implements JsonSerializable
{
    private string $path;

    public function getPath():string
    {
        return $this->path;
    }

    public function getName():string
    {
        return substr($this->path, 0, strpos($this->path, "."));
    }

    public function __construct($path)
    {
        parent::__construct($path);
        $this->path = $path;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function set($data)
    {
        parent::set($data);
    }
}