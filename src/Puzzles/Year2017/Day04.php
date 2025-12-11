<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2017;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day04 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $valid = 0;

        foreach ($input as $password) {
            $words = explode(' ', $password);
            $unique = array_unique($words);

            if (count($words) === count($unique)) {
                $valid++;
            }
        }

        return $valid;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $valid = 0;

        foreach ($input as $password) {
            $words = explode(' ', $password);
            $words = array_map(function (string $word): string {
                $word = str_split($word);
                sort($word);

                return implode('', $word);
            }, $words);

            $unique = array_unique($words);

            if (count($words) === count($unique)) {
                $valid++;
            }
        }

        return $valid;
    }
}
