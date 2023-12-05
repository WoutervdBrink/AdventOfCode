<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day15;

final class Sensor
{
    private function __construct(
        public readonly int $x,
        public readonly int $y,
        public readonly int $beaconX,
        public readonly int $beaconY,
    )
    {
    }

    public static function fromSpecification(string $line): Sensor
    {
        if (!preg_match('/Sensor at x=(-?\d+), y=(-?\d+): closest beacon is at x=(-?\d+), y=(-?\d+)/', $line, $matches)) {
            throw new \InvalidArgumentException(sprintf('Invalid sensor specification "%s"', $line));
        }

        $x = intval($matches[1]);
        $y = intval($matches[2]);
        $beaconX = intval($matches[3]);
        $beaconY = intval($matches[4]);

        return new Sensor($x, $y, $beaconX, $beaconY);
    }
}