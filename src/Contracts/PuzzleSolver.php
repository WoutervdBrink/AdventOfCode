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
     * @return string|int
     */
    public function part1(string $input): string|int;

    /**
     * Solve part 2 of the puzzle.
     * @param string $input
     * @return string|int
     */
    public function part2(string $input): string|int;
}