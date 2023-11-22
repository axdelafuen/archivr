<?php

class Sign extends Element
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
}

?>