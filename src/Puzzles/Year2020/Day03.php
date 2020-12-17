<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\TreeMap;

class Day03 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $map = new TreeMap($input);

        return $map->traverse(3, 1);
    }

    public function part2(string $input): int
    {
        $map = new TreeMap($input);

        return (
            $map->traverse(1, 1) *
            $map->traverse(3, 1) *
            $map->traverse(5, 1) *
            $map->traverse(7, 1) *
            $map->traverse(1, 2)
        );
    }
}