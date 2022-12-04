<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 5],
            [2, 1, 2],
            [3, 1, 12],
            [4, 2, 4],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 262;
    }
}