<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 37],
            [1, 2, 168]
        ];
    }

    public function getSolutionForPart1(): float
    {
        return 344735;
    }

    public function getSolutionForPart2(): float
    {
        return 96798233;
    }
}