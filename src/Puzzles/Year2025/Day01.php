<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day01 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        $cursor = 50;
        $hits = 0;

        foreach ($input as $move) {
            $cursor += ($move->direction === 'L' ? -1 : 1) * $move->amount;
            $cursor = $cursor % 100;

            if ($cursor === 0) {
                $hits++;
            }
        }

        return $hits;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        $cursor = 50;
        $hits = 0;

        foreach ($input as $move) {
            $direction = $move->direction === 'L' ? -1 : 1;

            for ($i = 0; $i < $move->amount; $i++) {
                $cursor = ($cursor + $direction) % 100;
                if ($cursor === 0) {
                    $hits++;
                }
            }
        }

        return $hits;
    }

    public static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if (! preg_match('/^([LR])(\d+)$/', $line, $matches)) {
                throw new RuntimeException('Invalid input line: '.$line);
            }

            [, $direction, $amount] = $matches;

            return (object) [
                'direction' => $direction,
                'amount' => $amount,
            ];
        });
    }
}
