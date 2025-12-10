<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day15;

use InvalidArgumentException;

final class Sensor
{
    public readonly int $distance;

    private function __construct(
        public readonly int $x,
        public readonly int $y,
        public readonly int $beaconX,
        public readonly int $beaconY,
    ) {
        $this->distance = $this->getDistanceTo($this->beaconX, $this->beaconY);
    }

    public static function fromSpecification(string $line): Sensor
    {
        if (! preg_match('/Sensor at x=(-?\d+), y=(-?\d+): closest beacon is at x=(-?\d+), y=(-?\d+)/', $line, $matches)) {
            throw new InvalidArgumentException(sprintf('Invalid sensor specification "%s"', $line));
        }

        $x = intval($matches[1]);
        $y = intval($matches[2]);
        $beaconX = intval($matches[3]);
        $beaconY = intval($matches[4]);

        return new Sensor($x, $y, $beaconX, $beaconY);
    }

    public function getDistanceTo(int $x, int $y): int
    {
        return abs($this->x - $x) + abs($this->y - $y);
    }
}
