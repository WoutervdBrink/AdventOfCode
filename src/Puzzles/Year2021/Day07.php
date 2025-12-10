<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day07 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): float
    {
        $input = InputManipulator::splitLines($input, ',', 'intval');

        sort($input);

        $c = intval(floor(count($input) / 2));

        $median = count($input) % 2
            ? ($input[$c] + $input[$c + 1])
            : $input[count($input) / 2];

        return array_sum(
            array_map(
                fn (float $fuel): float => abs(
                    $fuel - $median
                ),
                $input
            )
        );
    }

    #[Override]
    public function part2(string $input): float
    {
        $input = InputManipulator::splitLines($input, ',', 'intval');

        $mean = floor(array_sum($input) / count($input));

        return min(
            array_sum(
                array_map(
                    fn (float $fuel): float => self::plusFactorial(
                        abs(
                            $fuel - $mean
                        )
                    ),
                    $input
                )
            ),
            array_sum(
                array_map(
                    fn (float $fuel): float => self::plusFactorial(
                        abs(
                            $fuel - $mean - 1
                        )
                    ),
                    $input
                )
            )
        );
    }

    protected static function plusFactorial(float $n): float
    {
        return ($n * ($n + 1)) / 2;
    }
}
