<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day01 implements PuzzleSolver
{
    public function part1(string $input): float
    {
        $lines = self::parse($input);
        $score = 0;

        for ($i = 0; $i < count($lines[0]) && $i < count($lines[1]); $i++) {
            $score += abs($lines[0][$i] - $lines[1][$i]);
        }

        return $score;
    }

    public function part2(string $input): int
    {
        $lines = self::parse($input, sort: false);

        $occurrence = array_count_values($lines[1]);

        return array_reduce($lines[0], fn (int $score, int $number) => $score + $number * ($occurrence[$number] ?? 0), 0);
    }

    public static function parse(string $input, bool $sort = true): array
    {
        $lines = InputManipulator::splitLines(
            $input,
            manipulator: fn(string $line): array => explode('   ', $line, 2)
        );
        $lines = array_map(null, ...$lines);

        foreach ($lines as &$line) {
            $sort && sort($line);
        }

        return $lines;
    }
}