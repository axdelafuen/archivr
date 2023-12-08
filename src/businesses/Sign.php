<?php

class Sign extends Element implements JsonSerializable
{
    private string $content;

    public function getContent():string
    {
        return $this->content;
    }

    public function __construct($content)
    {
        parent::__construct($content);
        $this->content = $content;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}