<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Passport;

class Day04 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = explode("\n\n", $input);
        $valid = 0;

        foreach ($input as $specification) {
            $passport = Passport::fromSpecification($specification);

            if ($passport->hasAllFields()) {
                $valid++;
            }
        }

        return $valid;
    }

    public function part2(string $input): int
    {
        $input = explode("\n\n", $input);
        $valid = 0;

        foreach ($input as $specification) {
            $passport = Passport::fromSpecification($specification);

            if ($passport->isValid()) {
                $valid++;
            }
        }

        return $valid;
    }
}