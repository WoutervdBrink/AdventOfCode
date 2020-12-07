<?php


namespace Knevelina\AdventOfCode\Puzzles\Year2020;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\TreeMap;

/**
 * Day 3: Toboggan Trajectory
 * @package Knevelina\AdventOfCode\Puzzles
 */
class Day03 implements PuzzleSolver
{

    /**
     * @inheritDoc
     */
    public function part1(string $input): int
    {
        $map = new TreeMap($input);

        return $map->traverse(3, 1);
    }

    /**
     * @inheritDoc
     */
    public function part2(string $input): int
    {
        $map = new TreeMap($input);

        return (
            $map->traverse(1, 1) *
            $map->traverse(3, 1) *
            $map->traverse(5, 1) *
            $map->traverse(7, 1) *
            $map->traverse(1, 2)
        );
    }
}