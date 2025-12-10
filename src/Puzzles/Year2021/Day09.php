<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2021\Heightmap;
use Knevelina\AdventOfCode\Data\Year2021\LowPoint;
use Override;

class Day09 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $map = Heightmap::fromInput($input);

        $lowPoints = $map->getLowPoints();

        return array_sum(array_map(fn (LowPoint $point): int => $point->getValue() + 1, $lowPoints));
    }

    #[Override]
    public function part2(string $input): int
    {
        $map = Heightmap::fromInput($input);

        $lowPoints = $map->getLowPoints();

        $basinSizes = [];

        foreach ($lowPoints as $lowPoint) {
            $basin = $map->getBasin($lowPoint->getX(), $lowPoint->getY());

            $basinSizes[] = count($basin);
        }

        rsort($basinSizes);

        return $basinSizes[0] * $basinSizes[1] * $basinSizes[2];
    }
}
