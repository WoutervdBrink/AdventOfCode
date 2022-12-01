<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day01 implements PuzzleSolver
{
    private static function getElves(string $input): array
    {
        $input = InputManipulator::splitLines($input, manipulator: 'intval', filterEmpty: false);
        $accumulator = 0;
        $elves = [];

        foreach ($input as $number) {
            $accumulator += $number;
            if ($number === 0) {
                $elves[] = $accumulator;
                $accumulator = 0;
            }
        }

        if ($accumulator > 0) {
            $elves[] = $accumulator;
        }

        return $elves;
    }

    public function part1(string $input): int
    {
        return max(self::getElves($input));
    }

    public function part2(string $input): int
    {
        $elves = self::getElves($input);
        rsort($elves);
        return array_shift($elves) + array_shift($elves) + array_shift($elves);
    }
}