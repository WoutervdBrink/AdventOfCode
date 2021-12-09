<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

class LowPoint
{
    public function __construct(private int $x, private int $y, private int $value)
    {
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}