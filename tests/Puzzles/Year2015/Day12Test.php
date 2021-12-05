<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day12
 */
class Day12Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 6],
            [2, 1, 6],
            [3, 1, 3],
            [4, 1, 3],
            [5, 1, 0],
            [6, 1, 0],
            [7, 1, 0],
            [8, 1, 0],

            [1, 2, 6],
            [9, 2, 4],
            [10, 2, 0],
            [11, 2, 6]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 111754;
    }

    public function getSolutionForPart2(): int
    {
        return 65402;
    }
}