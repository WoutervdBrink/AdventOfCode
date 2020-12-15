<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day15 implements PuzzleSolver
{
    private function calculate(string $input, int $n): int
    {
        $input = explode(',', trim($input));
        $input = array_map(fn (string $num): int => intval($num), $input);

        $nums = [];

        for ($i = 0; $i < $n; $i++) {
            $nums[$i] = 0;
        }

        for ($i = 0; $i < count($input) - 1; $i++) {
            $num = $input[$i];
            $nums[$num] = $i + 1;
        }

        $last = last($input);

        for ($i = count($input); $i < $n; $i++) {
            if (($l = $nums[$last]) === 0) {
                $next = 0;
            } else {
                $next = $i - $l;
            }

            $nums[$last] = $i;
            $last = $next;
        }

        return $last;
    }

    public function part1(string $input): int
    {
        return $this->calculate($input, 2020);
    }

    public function part2(string $input): int
    {
        return $this->calculate($input, 30000000);
    }
}