<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day10 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = array_map('intval', str_split($input));

        for ($i = 0; $i < 40; $i++) {
            $input = self::lookAndSay($input);
        }

        return strlen(implode('', $input));
    }

    private static function lookAndSay(array $input): array
    {
        $amount = 0;
        $value = $input[0];
        $result = '';

        foreach ($input as $digit) {
            if ($digit !== $value) {
                $result .= $amount;
                $result .= $value;
                $amount = 0;
                $value = $digit;
            }

            $amount++;
        }

        $result .= $amount;
        $result .= $value;

        return array_map('intval', str_split($result));
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = array_map('intval', str_split($input));

        for ($i = 0; $i < 50; $i++) {
            $input = self::lookAndSay($input);
        }

        return strlen(implode('', $input));
    }
}
