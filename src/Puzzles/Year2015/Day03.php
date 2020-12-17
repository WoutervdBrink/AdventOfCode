<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day03 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = str_split($input);

        $x = 0;
        $y = 0;
        $houses = 1;

        $visited = ['0_0' => true];

        foreach ($input as $move) {
            $x += match ($move) {
                '<' => -1,
                '>' => 1,
                default => 0
            };
            $y += match ($move) {
                '^' => -1,
                'v' => 1,
                default => 0
            };

            if (!isset($visited[$x . '_' . $y])) {
                $houses++;
                $visited[$x . '_' . $y] = true;
            }
        }

        return $houses;
    }

    public function part2(string $input): int
    {
        $input = str_split($input);

        $x = [0, 0];
        $y = [0, 0];
        $turn = 0;

        $houses = 1;

        $visited = ['0_0' => true];

        foreach ($input as $move) {
            $x[$turn] += match ($move) {
                '<' => -1,
                '>' => 1,
                default => 0
            };
            $y[$turn] += match ($move) {
                '^' => -1,
                'v' => 1,
                default => 0
            };

            $key = sprintf('%d_%d', $x[$turn], $y[$turn]);

            if (!isset($visited[$key])) {
                $houses++;
                $visited[$key] = true;
            }

            $turn = ($turn + 1) % 2;
        }

        return $houses;
    }
}