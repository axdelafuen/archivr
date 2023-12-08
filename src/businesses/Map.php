<?php

class Map extends Image implements JsonSerializable
{

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

}
