<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day02 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $reports = array_map([self::class, 'inspect'], (self::parse($input)));

        $reports = array_filter($reports);

        return count($reports);
    }

    /**
     * @return array<array<int>>
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines(
            $input,
            manipulator: fn(string $line): array => array_map('intval', explode(' ', $line))
        );
    }

    public function part2(string $input): int
    {
        $reports = self::parse($input);
        $good = 0;

        foreach ($reports as $report) {
            if (self::inspect($report)) {
                $good++;
                continue;
            }

            for ($i = 0; $i < count($report); $i++) {
                $clone = [...$report];
                array_splice($clone, $i, 1);
                if (self::inspect($clone)) {
                    $good++;
                    continue 2;
                }
            }
        }

        return $good;
    }

    private static function inspect(array $report): bool
    {
        $cursor = $report[0];
        $direction = 0;

        for ($i = 1; $i < count($report); $i++) {
            $next = $report[$i];

            if ($direction === 0) {
                $direction = $next < $cursor ? -1 : 1;
            } else if ($direction === 1) {
                if ($next < $cursor) {
                    return false;
                }
            } else {
                if ($next > $cursor) {
                    return false;
                }
            }

            $diff = abs($next - $cursor);
            if ($diff < 1 || $diff > 3) {
                return false;
            }

            $cursor = $next;
        }

        return true;
    }
}