<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day01 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = InputManipulator::getListOfIntegers($input);
        $acc = 0;

        for ($i = 1; $i < count($input); $i++) {
            if ($input[$i] > $input[$i - 1]) {
                $acc++;
            }
        }

        return $acc;
    }

    public function part2(string $input): int
    {
        $input = InputManipulator::getListOfIntegers($input);
        $acc = 0;

        for ($i = 3; $i < count($input); $i++) {
            $common = $input[$i - 2] + $input[$i - 1];
            $previous = $input[$i - 3] + $common;
            $current = $common + $input[$i];
            if ($current > $previous) {
                $acc++;
            }
        }

        return $acc;
    }
}