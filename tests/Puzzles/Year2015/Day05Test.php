<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 1],
            [3, 1, 0],
            [4, 1, 0],
            [5, 1, 0],

            [6, 2, 1],
            [7, 2, 1],
            [8, 2, 0],
            [9, 2, 0]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 236;
    }

    public function getSolutionForPart2(): int
    {
        return 51;
    }
}