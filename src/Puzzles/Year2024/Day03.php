<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day03 implements PuzzleSolver
{
    /**
     * @param string $input
     * @return list<int>
     */
    private static function solve(string $input): array
    {
        $cursor = 0;
        $factor = 1;
        $part1 = 0;
        $part2 = 0;

        while ($cursor < strlen($input)) {
            $peek = substr($input, $cursor, 7);

            if (str_starts_with($peek, 'mul(')) {
                $cursor += 4;
            } else if (str_starts_with($peek, 'do()')) {
                $cursor += 4;
                $factor = 1;
                continue;
            } else if ($peek === 'don\'t()') {
                $factor = 0;
                $cursor += 7;
                continue;
            } else {
                $cursor += 1;
                continue;
            }

            $num1 = 0;
            $num2 = 0;

            while (is_numeric($char = $input[$cursor])) {
                $num1 = 10 * $num1 + intval($char);
                $cursor++;
            }

            if ($input[$cursor] !== ',') {
                continue;
            }
            $cursor++;

            while (is_numeric($char = $input[$cursor])) {
                $num2 = 10 * $num2 + intval($char);
                $cursor++;
            }

            if ($input[$cursor] !== ')') {
                continue;
            }
            $cursor++;

            $part1 += $num1 * $num2;
            $part2 += $num1 * $num2 * $factor;
        }

        return [$part1, $part2];
    }

    public function part1(string $input): int
    {
        return self::solve($input)[0];
    }

    public function part2(string $input): int
    {
        return self::solve($input)[1];
    }
}