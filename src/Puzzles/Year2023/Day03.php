<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day03\Schematic;

class Day03 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return Schematic::fromInput($input)->getSumOfPartNumbers();
    }

    public function part2(string $input): int
    {
        return Schematic::fromInput($input)->getSumOfGearRatios();
    }
}