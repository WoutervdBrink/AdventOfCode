<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Generator;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use RuntimeException;

class Day01 implements PuzzleSolver
{
    const NORTH = 0;
    const EAST = 1;
    const SOUTH = 2;
    const WEST = 3;

    const RIGHT = 1;
    const LEFT = -1;

    /**
     * @param string $input
     * @return Generator<array<int>>
     */
    private static function getMoves(string $input): Generator
    {
        $input = InputManipulator::splitLines($input, delimiter: ',', manipulator: function (string $move): array {
            if (!preg_match('/([LR])(\d+)/', $move, $matches)) {
                throw new RuntimeException(sprintf('Invalid move "%s"', $move));
            }

            return [
                match ($matches[1]) {
                    'L' => self::LEFT,
                    'R' => self::RIGHT,
                },
                intval($matches[2])
            ];
        });

        $direction = self::NORTH;

        $x = 0;
        $y = 0;

        foreach ($input as $move) {
            $direction = ($direction + $move[0]) % 4;

            if ($direction < 0) {
                $direction += 4;
            }

            $x += match ($direction) {
                self::EAST => $move[1],
                self::WEST => -$move[1],
                default => 0,
            };

            $y += match ($direction) {
                self::NORTH => $move[1],
                self::SOUTH => -$move[1],
                default => 0,
            };

            yield [$direction, $move[1], $x, $y];
        }
    }

    public function part1(string $input): float
    {
        $moves = self::getMoves($input);

        while ($moves->valid()) {
            [, , $x, $y] = $moves->current();
            $moves->next();
        }

        return abs($x) + abs($y);
    }

    public function part2(string $input): int
    {
        $x = 0;
        $y = 0;

        $history = [];

        foreach (self::getMoves($input) as $move) {
            [$direction, $distance] = $move;

            for ($i = 0; $i < $distance; $i++) {
                $x += match ($direction) {
                    self::EAST => 1,
                    self::WEST => -1,
                    self::NORTH, self::SOUTH => 0
                };

                $y += match ($direction) {
                    self::NORTH => 1,
                    self::SOUTH => -1,
                    self::EAST, self::WEST => 0
                };

                $key = $x . '_' . $y;

                if (isset($history[$key])) {
                    return abs($x) + abs($y);
                }

                $history[$key] = true;
            }
        }
    }
}