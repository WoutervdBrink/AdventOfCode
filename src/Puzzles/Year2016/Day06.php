<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day06 implements PuzzleSolver
{
    const APPROACH_MIN = 0;

    const APPROACH_MAX = 1;

    #[Override]
    public function part1(string $input): string
    {
        return self::solve($input, self::APPROACH_MAX);
    }

    private static function solve(string $input, int $approach): string
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');

        $occurrences = array_fill(0, count($input[0]), []);

        foreach ($input as $message) {
            foreach ($message as $col => $character) {
                if (! isset($occurrences[$col][$character])) {
                    $occurrences[$col][$character] = 0;
                }

                $occurrences[$col][$character]++;
            }
        }

        $message = '';

        foreach ($occurrences as $occurrence) {
            $maxValue = $approach === self::APPROACH_MAX ? 0 : INF;
            $maxLetter = '';
            foreach ($occurrence as $letter => $value) {
                if (
                    ($approach === self::APPROACH_MAX && $value > $maxValue) ||
                    ($approach === self::APPROACH_MIN && $value < $maxValue)
                ) {
                    $maxLetter = $letter;
                    $maxValue = $value;
                }
            }

            $message .= $maxLetter;
        }

        return $message;
    }

    #[Override]
    public function part2(string $input): string
    {
        return self::solve($input, self::APPROACH_MIN);
    }
}
