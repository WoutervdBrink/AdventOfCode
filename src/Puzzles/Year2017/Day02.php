<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2017;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day02 implements PuzzleSolver
{
    /**
     * @return array<array<int>>
     */
    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: fn (string $line): array => array_map('intval', preg_split('/\W+/', $line)));
    }

    #[Override]
    public function part1(string $input): float
    {
        $input = self::parseInput($input);

        return array_sum(array_map(function (array $nums): float {
            return abs(max($nums) - min($nums));
        }, $input));
    }

    #[Override]
    public function part2(string $input): float
    {
        $input = self::parseInput($input);

        $sum = 0;

        foreach ($input as $line) {
            for ($i = 0; $i < count($line); $i++) {
                for ($j = 0; $j < count($line); $j++) {
                    $first = intval($line[$i]);
                    $second = intval($line[$j]);

                    if ($first <= $second) {
                        continue;
                    }

                    if ($first % $second === 0) {
                        $sum += $first / $second;
                        break;
                    }
                }
            }
        }

        return $sum;
    }
}
