<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day15
 */
class Day15Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 10],
            [3, 1, 27],
            [4, 1, 78],
            [5, 1, 438],
            [6, 1, 1836],
            [7, 1, 436],

            // Slow
            [1, 2, 2578],
            [2, 2, 3544142],
            [3, 2, 261214],
            [4, 2, 6895259],
            [5, 2, 18],
            [6, 2, 362],
            [7, 2, 175594]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 410;
    }

    // Slow
    public function getSolutionForPart2(): int|null
    {
        return 238;
    }
}