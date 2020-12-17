<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Ds\Vector;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day15 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return static::calculate($input, 2020);
    }

    public static function calculate(string $input, int $n): int
    {
        $input = explode(',', trim($input));
        $input = array_map(fn(string $num): int => intval($num), $input);

        $nums = new Vector(array_fill(0, $n, 0));

        $count = count($input);
        for ($i = 0; $i < $count - 1; $i++) {
            $num = $input[$i];
            $nums[$num] = $i + 1;
        }

        $last = last($input);

        for ($i = $count; $i < $n; $i++) {
            $next = match ($l = $nums[$last]) {
                0 => 0,
                default => $i - $l
            };

            $nums[$last] = $i;
            $last = $next;
        }

        return $last;
    }

    public function part2(string $input): int
    {
        return static::calculate($input, 30000000);
    }
}