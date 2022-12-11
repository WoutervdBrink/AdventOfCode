<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2017\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 3],
            [2, 1, 4],
            [3, 1, 0],
            [4, 1, 9],

            [5, 2, 6],
            [6, 2, 0],
            [7, 2, 4],
            [8, 2, 12],
            [9, 2, 4],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1141;
    }

    public function getSolutionForPart2(): int
    {
        return 950;
    }
}