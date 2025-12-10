<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;
use SplFixedArray;

class Day15 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        return static::calculate($input, 2020);
    }

    public static function calculate(string $input, int $n): int
    {
        $input = explode(',', trim($input));
        $input = array_map(fn (string $num): int => intval($num), $input);

        $last = last($input);
        $c = new SplFixedArray($n);

        for ($i = 0; $i < count($input); $i++) {
            $c[$input[$i]] = $i;
        }

        for ($i = count($input) - 1; $i < $n - 1; $i++) {
            $temp = $i - ($c[$last] ?? $i);
            $c[$last] = $i;
            $last = $temp;
        }

        return $last;
    }

    #[Override]
    public function part2(string $input): int
    {
        return static::calculate($input, 30000000);
    }
}
