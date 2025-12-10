<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2022\Day04\Range;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day04 implements PuzzleSolver
{
    /**
     * @return array<array<Range>>
     */
    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): array {
            if (! preg_match('/^(\d+)-(\d+),(\d+)-(\d+)$/', $line, $matches)) {
                throw new RuntimeException(sprintf('Could not parse line "%s"', $line));
            }

            return [
                new Range(intval($matches[1]), intval($matches[2])),
                new Range(intval($matches[3]), intval($matches[4])),
            ];
        });
    }

    #[Override]
    public function part1(string $input): int
    {
        return array_reduce(
            self::parseInput($input),
            function (int $total, array $pair): int {
                /** @var array<Range> $pair */
                [$first, $second] = $pair;

                return $first->contains($second) || $second->contains($first)
                    ? $total + 1 : $total;
            },
            0
        );
    }

    #[Override]
    public function part2(string $input): int
    {
        return array_reduce(
            self::parseInput($input),
            function (int $total, array $pair): int {
                /** @var array<Range> $pair */
                [$first, $second] = $pair;

                return $first->hasOverlapWith($second) ? $total + 1 : $total;
            },
            0
        );
    }
}
