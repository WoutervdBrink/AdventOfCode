<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Set;
use Knevelina\AdventOfCode\InputManipulator;

class Day09 implements PuzzleSolver
{
    private static function solve(string $input, int $initialBest, callable $bestFunction): int
    {
        $input = InputManipulator::splitLines($input);

        $distances = [];

        $locations = [];

        foreach ($input as $route) {
            if (!preg_match('/^([a-zA-Z]+) to ([a-zA-Z]+) = (\d+)$/', $route, $matches)) {
                throw new \InvalidArgumentException(sprintf('Invalid route definition "%s"', $route));
            }

            $from = $matches[1];
            $to = $matches[2];
            $distance = intval($matches[3]);

            $locations[] = $from;
            $locations[] = $to;

            if (!isset($distances[$from])) {
                $distances[$from] = [];
            }
            if (!isset($distances[$to])) {
                $distances[$to] = [];
            }

            $distances[$from][$to] = $distance;
            $distances[$to][$from] = $distance;
        }

        $locations = Set::fromArray($locations);
        $best = $initialBest;

        foreach ($locations->permutations() as $permutation) {
            $cursor = $permutation[0];
            $distance = 0;

            for ($i = 1; $i < count($permutation); $i++) {
                $next = $permutation[$i];
                $distance += $distances[$cursor][$next];
                $cursor = $next;
            }

            $best = $bestFunction($best, $distance);
        }

        return $best;
    }

    public function part1(string $input): int
    {
        return self::solve($input, PHP_INT_MAX, 'min');
    }

    public function part2(string $input): int
    {
        return self::solve($input, 0, 'max');
    }
}