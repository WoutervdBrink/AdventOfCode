<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

class LowPoint
{
    public function __construct(private int $x, private int $y, private int $value) {}

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
