<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Ds\Map;
use Ds\Queue;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day11 implements PuzzleSolver
{
    private static function simulate(string $input, int $iterations): int
    {
        $input = InputManipulator::splitLines($input, delimiter: ' ', manipulator: 'intval');

        /** @var Map<int, int> $map */
        $map = new Map(array_count_values($input));

        for ($i = 0; $i < $iterations; $i++) {
            /** @var Map<int, int> $next */
            $next = new Map();
            foreach ($map->keys() as $stone) {
                $count = $map->get($stone);

                if ($count === 0) {
                    continue;
                }

                $digits = floor(log10($stone) + 1);

                if ($stone === 0) {
                    // Every 0 becomes a 1...
                    $next->put(1, $next->get(1, 0) + $count);
                } else if ($digits % 2 === 0) {
                    // Every even digit becomes two stones: one left, one right
                    $newDigits = $digits / 2;
                    $left = intdiv($stone, (int) pow(10, $newDigits));
                    $right = $stone - (int) ($left * pow(10, $newDigits));

                    $next->put($left, $next->get($left, 0) + $count);
                    $next->put($right, $next->get($right, 0) + $count);
                } else {
                    // Otherwise, multiply by 2024.
                    $next->put($stone * 2024, $next->get($stone * 2024, 0) + $count);
                }
            }
            $map = $next;
        }

        return (int) $map->sum();
    }

    public function part1(string $input): int
    {
        return self::simulate($input, 25);
    }

    public function part2(string $input): int
    {
        return self::simulate($input, 75);
    }
}