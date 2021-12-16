<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2021\OctopusMap;

class Day11 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $map = OctopusMap::fromInput($input);
        $flashes = 0;

        for ($step = 0; $step < 100; $step++) {
            $flashes += $map->iterate();
        }

        return $flashes;
    }

    public function part2(string $input): int
    {
        $map = OctopusMap::fromInput($input);

        $steps = 0;

        while (true) {
            $flashes = $map->iterate();
            $steps++;

            if ($flashes === $map->getWidth() * $map->getHeight()) {
                break;
            }
        }

        return $steps;
    }
}