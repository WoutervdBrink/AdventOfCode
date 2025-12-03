<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day03 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return self::solve($input, 2);
    }

    public function part2(string $input): int
    {
        return self::solve($input, 12);
    }

    private static function solve(string $input, int $digits): int
    {
        $banks = self::parseInput($input);
        $solution = 0;

        foreach ($banks as $bank) {
            $num = 0;
            $last = 0;

            for ($i = 0; $i < $digits; $i++) {
                $max = 0;
                $maxIndex = 0;
                for ($j = $last; $j < count($bank) - ($digits - ($i + 1)); $j++) {
                    if ($bank[$j] > $max) {
                        $max = $bank[$j];
                        $maxIndex = $j;
                    }
                }

                $num *= 10;
                $num += $max;
                $last = $maxIndex + 1;
            }

            $solution += $num;
        }

        return $solution;
    }

    /**
     * @param string $input
     * @return int[][]
     */
    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: fn (string $line): array => array_map('intval', str_split($line)));
    }
}