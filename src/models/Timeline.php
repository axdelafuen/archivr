<?php

class Timeline implements JsonSerializable
{

    private string $id; // string ? int ?

    private array $views;

    public function jsonSerialize(): array{
        return get_object_vars($this);
    }
}

?>