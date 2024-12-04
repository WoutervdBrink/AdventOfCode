<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 4],
            [2, 1, 18],
            [3, 2, 1],
            [2, 2, 9],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 2507;
    }

    public function getSolutionForPart2(): int
    {
        return 1969;
    }
}