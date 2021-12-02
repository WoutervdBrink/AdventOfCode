<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

class Route
{
    public function __construct(
        private string $from,
        private string $to,
        private int $distance
    )
    {
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }


}