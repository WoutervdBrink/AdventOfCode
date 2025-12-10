<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day05\Almanac;
use Override;

class Day05 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $almanac = Almanac::fromSpecification($input);

        return $almanac->getMinLocationForSeeds();
    }

    #[Override]
    public function part2(string $input): int
    {
        return Almanac::fromSpecification($input)->getMinLocationForSeedRanges();
    }
}
