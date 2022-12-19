<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day14
 */
class Day14Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 24],
            [1, 2, 93],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 805;
    }

    public function getSolutionForPart2(): int
    {
        return 25161;
    }
}