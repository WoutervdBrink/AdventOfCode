<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day03\Schematic;
use Override;

class Day03 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        return Schematic::fromInput($input)->getSumOfPartNumbers();
    }

    #[Override]
    public function part2(string $input): int
    {
        return Schematic::fromInput($input)->getSumOfGearRatios();
    }
}
