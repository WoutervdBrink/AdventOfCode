<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day07 implements PuzzleSolver
{
    public function part1(string $input): float
    {
        $input = InputManipulator::splitLines($input, ',', 'intval');
        sort($input);
        return array_sum(array_map(fn (float $fuel): float => abs($fuel - (count($input) % 2 ? (($input[floor(count($input) / 2)] + $input[floor(count($input) / 2) + 1])) : $input[count($input) / 2])), $input));
    }

    public function part2(string $input): float
    {
        $input = InputManipulator::splitLines($input, ',', 'intval');
        return min(array_sum(array_map(fn (float $fuel): float => (($n = (abs($fuel - (floor(array_sum($input) / count($input)))))) * ($n + 1)) / 2, $input)), array_sum(array_map(fn (float $fuel): float => (($n = (abs($fuel - (floor(array_sum($input) / count($input))) - 1))) * ($n + 1)) / 2, $input)));
    }
}