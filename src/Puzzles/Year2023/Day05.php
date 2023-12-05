<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day05\Almanac;

class Day05 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $almanac = Almanac::fromSpecification($input);

        return $almanac->getMinLocationForSeeds();
    }

    public function part2(string $input): int
    {
        return Almanac::fromSpecification($input)->getMinLocationForSeedRanges();
    }
}