<?php


namespace Knevelina\AdventOfCode\Contracts;

/**
 * Solves an Advent of Code puzzle for one specific day.
 *
 * @package Knevelina\AdventOfCode
 */
interface PuzzleSolver
{
    /**
     * Solve part 1 of the puzzle.
     * @param string $input
     * @return int
     */
    public function part1(string $input): int;

    /**
     * Solve part 2 of the puzzle.
     * @param string $input
     * @return int
     */
    public function part2(string $input): int;
}