<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 0],
            [3, 1, 0],
            [4, 1, 1],

            [5, 2, 1],
            [6, 2, 0],
            [7, 2, 1],
            [8, 2, 1],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 110;
    }

    public function getSolutionForPart2(): int
    {
        return 242;
    }
}