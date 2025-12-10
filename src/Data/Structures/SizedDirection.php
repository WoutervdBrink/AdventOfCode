<?php

namespace Knevelina\AdventOfCode\Data\Structures;

class SizedDirection
{
    public function __construct(private readonly Direction $direction, private readonly int $length) {}

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
