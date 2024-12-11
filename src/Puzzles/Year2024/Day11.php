<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Ds\Map;
use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day11 extends CombinedPuzzleSolver
{
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $input = InputManipulator::splitLines($input, delimiter: ' ', manipulator: 'intval');

        /** @var Map<int, int> $map */
        $map = new Map(array_count_values($input));

        $part1 = 0;

        for ($i = 0; $i < 75; $i++) {
            /** @var Map<int, int> $next */
            $next = new Map();
            foreach ($map->keys() as $stone) {
                $count = $map->get($stone);

                $digits = floor(log10($stone) + 1);

                if ($stone === 0) {
                    // Every 0 becomes a 1...
                    $next->put(1, $next->get(1, 0) + $count);
                } else if ($digits % 2 === 0) {
                    // Every even digit becomes two stones: one left, one right
                    $newDigits = $digits / 2;
                    $left = intdiv($stone, (int)pow(10, $newDigits));
                    $right = $stone - (int)($left * pow(10, $newDigits));

                    $next->put($left, $next->get($left, 0) + $count);
                    $next->put($right, $next->get($right, 0) + $count);
                } else {
                    // Otherwise, multiply by 2024.
                    $next->put($stone * 2024, $next->get($stone * 2024, 0) + $count);
                }
            }

            $map = $next;

            if ($i === 24) {
                $part1 = $map->sum();
            }
        }

        return CombinedPuzzleOutput::of($part1, $map->sum());
    }
}