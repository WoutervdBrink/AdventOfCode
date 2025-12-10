<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day06 implements PuzzleSolver
{
    private static function solve(string $input, int $bufferSize): int
    {
        $input = str_split($input);

        $buffer = array_splice($input, 0, $bufferSize);

        foreach ($input as $i => $next) {
            array_shift($buffer);
            $buffer[] = $next;
            $found = [];
            foreach ($buffer as $c) {
                if (isset($found[$c])) {
                    break;
                }
                $found[$c] = true;
            }
            if (count($found) === $bufferSize) {
                return $i + $bufferSize + 1;
            }
        }

        return 0;
    }

    #[Override]
    public function part1(string $input): int
    {
        return self::solve($input, 4);
    }

    #[Override]
    public function part2(string $input): int
    {
        return self::solve($input, 14);
    }
}
