<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day04 implements PuzzleSolver
{
    const CHR_0 = "\0";

    #[Override]
    public function part1(string $input): int
    {
        $key = trim($input);

        for ($num = 0; $num < 1e7; $num++) {
            $hash = md5($key.$num, true);

            if ($hash[0] === self::CHR_0 && $hash[1] === self::CHR_0 && (ord($hash[2]) & 0b11110000) === 0) {
                return $num;
            }
        }

        return 0;
    }

    #[Override]
    public function part2(string $input): int
    {
        $key = trim($input);

        for ($num = 0; $num < 1e7; $num++) {
            $hash = md5($key.$num, true);

            if ($hash[0] === self::CHR_0 && $hash[1] === self::CHR_0 && $hash[2] === self::CHR_0) {
                return $num;
            }
        }

        return 0;
    }
}
