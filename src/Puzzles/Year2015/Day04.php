<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day04 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        $key = trim($input);

        for ($num = 0; $num < 1e7; $num++) {
            $hash = md5($key.$num);

            if (str_starts_with($hash, '00000')) {
                return $num;
            }
        }

        return 0;
    }

    public function part2(string $input): int
    {
        $key = trim($input);

        for ($num = 0; $num < 1e7; $num++) {
            $hash = md5($key.$num);

            if (str_starts_with($hash, '000000')) {
                return $num;
            }
        }

        return 0;
    }
}