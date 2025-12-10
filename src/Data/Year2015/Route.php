<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

class Route
{
    public function __construct(
        private string $from,
        private string $to,
        private int $distance
    ) {}

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }
}
