<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day10
 */
class Day10Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 35],
            [2, 1, 220],

            [1, 2, 8],
            [2, 2, 19208]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 2046;
    }
}