<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Year2022\Day15\Sensor;
use Knevelina\AdventOfCode\InputManipulator;

class Day15 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        /** @var array<Sensor> $sensors */
        $sensors = InputManipulator::splitLines($input, manipulator: Sensor::fromSpecification(...));

        // HACK: The target Y differs between the example and the actual puzzle.
        $targetY = count($sensors) < 20 ? 10 : 2000000;

        $minX = min(array_map(fn(Sensor $sensor): int => $sensor->x, $sensors));
        $minBeaconX = min(array_map(fn(Sensor $sensor): int => $sensor->beaconX, $sensors));

        $maxX = max(array_map(fn(Sensor $sensor): int => $sensor->x, $sensors));
        $maxBeaconX = max(array_map(fn(Sensor $sensor): int => $sensor->beaconX, $sensors));

        $start = min($minX, $minBeaconX);
        $end = max($maxX, $maxBeaconX);

        $line = array_fill($start, ($end - $start), 0);
        $beaconsOnLine = [];

        foreach ($sensors as $sensor) {
            $dX = $sensor->beaconX - $sensor->x;
            $dY = $sensor->beaconY - $sensor->y;

            // Radius: the amount of 'unavailable' pixels horizontally, starting from the sensor.
            // In the example, this is 9 -- there are 9 #s from S going left or right.
            $radius = abs($dX) + abs($dY) + 1;

            $radius -= abs($sensor->y - $targetY);

            if ($radius > 0) {
                for ($xx = 0; $xx < $radius; $xx++) {
                    $line[$sensor->x + $xx] = 1;
                    $line[$sensor->x - $xx] = 1;
                }
            }

            if ($sensor->beaconY === $targetY) {
                $beaconsOnLine[] = $sensor->beaconX;
            }
        }

        foreach ($beaconsOnLine as $x) {
            $line[$x] = 0;
        }

        return count(array_filter($line));
    }

    public function part2(string $input): int
    {
        /** @var array<Sensor> $sensors */
        $sensors = InputManipulator::splitLines($input, manipulator: Sensor::fromSpecification(...));

        // HACK: The target Y differs between the example and the actual puzzle.
        $targetX = count($sensors) < 20 ? 20 : 4000000;
        $targetY = count($sensors) < 20 ? 20 : 4000000;

        // TODO
        return 0;
    }
}