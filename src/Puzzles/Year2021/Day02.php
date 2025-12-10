<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day02 implements PuzzleSolver
{
    private static function parseInstruction(string $line): object
    {
        [$direction, $distance] = explode(' ', $line, 2);

        return (object) [
            'direction' => $direction,
            'distance' => intval($distance),
        ];
    }

    private static function parseInstructions(string $input): array
    {
        $input = InputManipulator::splitLines($input);

        return array_map([static::class, 'parseInstruction'], $input);
    }

    #[Override]
    public function part1(string $input): int
    {
        $instructions = self::parseInstructions($input);

        $horizontal = 0;
        $depth = 0;

        foreach ($instructions as $instruction) {
            $horizontal += match ($instruction->direction) {
                'forward' => $instruction->distance,
                default => 0
            };

            $depth += match ($instruction->direction) {
                'down' => $instruction->distance,
                'up' => -$instruction->distance,
                default => 0
            };
        }

        return $horizontal * $depth;
    }

    #[Override]
    public function part2(string $input): int
    {
        $instructions = self::parseInstructions($input);

        $horizontal = 0;
        $aim = 0;
        $depth = 0;

        foreach ($instructions as $instruction) {
            switch ($instruction->direction) {
                case 'down':
                    $aim += $instruction->distance;
                    break;
                case 'up':
                    $aim -= $instruction->distance;
                    break;
                case 'forward':
                    $horizontal += $instruction->distance;
                    $depth += $aim * $instruction->distance;
                    break;
            }
        }

        return $horizontal * $depth;
    }
}
