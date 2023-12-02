<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day01 implements PuzzleSolver
{
    const DIGITS = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
        'zero' => 0,
    ];

    public function part1(string $input): int
    {
        return self::solve($input, includeWords: false);
    }

    public function part2(string $input): int
    {
        return self::solve($input, includeWords: true);
    }

    private function solve(string $input, bool $includeWords): int
    {
        return (int) array_sum(InputManipulator::splitLines($input, manipulator: function (string $line) use ($includeWords): int {
            $digits = '';

            for ($i = 0; $i < strlen($line); $i++) {
                $c = $line[$i];

                if (ord($c) >= ord('0') && ord($c) <= ord('9')) {
                    $digits .= $c;
                }

                if ($includeWords) {
                    foreach (self::DIGITS as $digit => $value) {
                        if (substr($line, $i, strlen($digit)) === $digit) {
                            $digits .= $value;
                        }
                    }
                }
            }

            return intval($digits[0] . $digits[strlen($digits) - 1]);
        }));
    }
}