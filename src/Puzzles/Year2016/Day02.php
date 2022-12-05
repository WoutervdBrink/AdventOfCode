<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day02 implements PuzzleSolver
{
    const KEYPAD_PART1 = [
        ['1', '2', '3'],
        ['4', '5', '6'],
        ['7', '8', '9'],
    ];

    const KEYPAD_PART2 = [
        [null, null, '1', null, null],
        [null, '2', '3', '4', null],
        ['5', '6', '7', '8', '9'],
        [null, 'A', 'B', 'C', null],
        [null, null, 'D', null, null],
    ];

    /**
     * @param string $input
     * @param array<array<string|null>> $keypad
     * @param int $x
     * @param int $y
     * @return string
     */
    private static function solve(string $input, array $keypad, int $x, int $y): string
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');

        $code = '';

        foreach ($input as $sequence) {
            foreach ($sequence as $move) {
                $nextX = $x + match ($move) {
                    'L' => -1,
                    'R' => 1,
                    'U', 'D' => 0,
                    default => throw new \RuntimeException(sprintf('Invalid move "%s"', $move))
                };

                $nextY = $y + match ($move) {
                    'U' => -1,
                    'D' => 1,
                    'L', 'R' => 0,
                    default => throw new \RuntimeException(sprintf('Invalid move "%s"', $move))
                };

                if (isset($keypad[$nextY][$nextX])) {
                    $x = $nextX;
                    $y = $nextY;
                }
            }

            $code .= $keypad[$y][$x];
        }

        return $code;
    }

    public function part1(string $input): string
    {
        return self::solve($input, self::KEYPAD_PART1, 1, 1);
    }

    public function part2(string $input): string
    {
        return self::solve($input, self::KEYPAD_PART2, 0, 2);
    }
}