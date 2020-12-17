<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 0],
            [2, 1, 0],
            [3, 1, 3],
            [4, 1, 3],
            [5, 1, 3],
            [6, 1, -1],
            [7, 1, -1],
            [8, 1, -3],
            [9, 1, -3],

            [10, 2, 1],
            [11, 2, 5]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 280;
    }

    public function getSolutionForPart2(): int
    {
        return 1797;
    }
}