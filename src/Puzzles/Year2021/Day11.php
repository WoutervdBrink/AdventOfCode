<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2021\OctopusGrid;
use Override;

class Day11 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $map = OctopusGrid::fromInput($input);
        $flashes = 0;

        for ($step = 0; $step < 100; $step++) {
            $flashes += $map->iterate();
        }

        return $flashes;
    }

    #[Override]
    public function part2(string $input): int
    {
        $map = OctopusGrid::fromInput($input);

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
