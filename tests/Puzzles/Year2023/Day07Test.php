<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 6440],
            [1, 2, 5905],
            [2, 2, 5911],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 249748283;
    }
}