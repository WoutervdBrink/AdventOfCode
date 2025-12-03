<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day02 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return self::solve($input, fn (int $id): bool => preg_match('/^(\d+)\1$/', $id));
    }

    public function part2(string $input): int
    {
        return self::solve($input, fn (int $id): bool => preg_match('/^(\d+)\1+$/', $id));
    }

    /**
     * @param string $input
     * @param callable(int $id): bool $validator
     * @return int
     */
    private static function solve(string $input, callable $validator): int
    {
        /** @var object{a: int, b: int}[] $ranges */
        $ranges = InputManipulator::splitLines($input, delimiter: ',', manipulator: function (string $line): object {
            if (!preg_match('/^(\d+)-(\d+)$/', $line, $matches)) {
                throw new InvalidArgumentException('Invalid line: ' . $line);
            }

            $a = intval($matches[1]);
            $b = intval($matches[2]);

            if ($a > $b) {
                throw new InvalidArgumentException('Invalid range (a > b): ' . $line);
            }

            return (object)[
                'a' => $a,
                'b' => $b,
            ];
        });

        $hits = 0;

        foreach ($ranges as $range) {
            for ($i = $range->a; $i <= $range->b; $i++) {
                if ($validator($i)) {
                    $hits += $i;
                }
            }
        }

        return $hits;
    }
}