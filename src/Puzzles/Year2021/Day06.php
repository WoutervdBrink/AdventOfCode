<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day06 implements PuzzleSolver
{
    public static function step(array $fish): array
    {
        $newFish = [];

        foreach ($fish as $f) {
            $f--;
            if ($f < 0) {
                $f = 6;
                $newFish[] = 8;
            }
            $newFish[] = $f;
        }

        return $newFish;
    }

    public static function simulateEverything(array $fish, int $steps): int
    {
        $map = array_fill(0, 9, 0);

        foreach ($fish as $f) {
            $map[$f]++;
        }

        $newMap = array_fill(0, 9, 0);

        for ($i = 0; $i < $steps; $i++) {
            for ($k = 7; $k >= 0; $k--) {
                $newMap[$k] = $map[$k + 1];
            }
            $newMap[8] = $map[0];
            $newMap[6] += $map[0];
            $map = $newMap;
        }

        return array_sum($map);
    }

    public function part1(string $input): int
    {
        $fish = InputManipulator::splitLines($input, ',', 'intval');

        return self::simulateEverything($fish, 80);
    }

    public function part2(string $input): int
    {
        $fish = InputManipulator::splitLines($input, ',', 'intval');

        return self::simulateEverything($fish, 256);
    }
}