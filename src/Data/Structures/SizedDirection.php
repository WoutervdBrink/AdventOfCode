<?php

namespace Knevelina\AdventOfCode\Data\Structures;

class SizedDirection
{
    public function __construct(private readonly Direction $direction, private readonly int $length)
    {
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }
}