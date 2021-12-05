<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day05 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return $this->solve($input, false);
    }

    private function solve(string $input, bool $considerDiagonals): int
    {
        $lines = InputManipulator::splitLines($input, "\n", fn(string $line): ?array => sscanf($line, '%d,%d -> %d,%d')
        );
        $map = [];

        foreach ($lines as $line) {
            list($x1, $y1, $x2, $y2) = $line;

            $horizontal = ($x2 - $x1) > 0 ? 1 : -1;
            $vertical = ($y2 - $y1) > 0 ? 1 : -1;

            $keys = match (true) {
                $x1 === $x2 => array_map(fn(int $y): string => $x1 . '_' . $y, range($y1, $y2)),
                $y1 === $y2 => array_map(fn(int $x): string => $x . '_' . $y1, range($x1, $x2)),
                default => $considerDiagonals ? array_map(
                    fn(int $i): string => ($x1 + $horizontal * $i) . '_' . ($y1 + $vertical * $i),
                    range(0, abs($x2 - $x1))
                ) : []
            };

            foreach ($keys as $key) {
                if (!isset($map[$key])) {
                    $map[$key] = 0;
                }

                $map[$key]++;
            }
        }

        return count(array_filter($map, fn(int $count): bool => $count > 1));
    }

    public function part2(string $input): int
    {
        return $this->solve($input, true);
    }
}