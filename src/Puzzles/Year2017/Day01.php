<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2017;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day01 implements PuzzleSolver
{
    private static function solve(string $input, int $offset): int
    {
        $sum = 0;

        for ($i = 0; $i < strlen($input); $i++) {
            $current = $input[$i];
            $next = $input[($i + $offset) % strlen($input)];

            if ($current === $next) {
                $sum += intval($current);
            }
        }

        return $sum;
    }

    #[Override]
    public function part1(string $input): int
    {
        return self::solve($input, 1);
    }

    #[Override]
    public function part2(string $input): int
    {
        return self::solve($input, intval(strlen($input) / 2));
    }
}
