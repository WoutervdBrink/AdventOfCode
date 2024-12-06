<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day06
 */
class Day06Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 41],
            [1, 2, 6],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 4964;
    }

    public function getSolutionForPart2(): int
    {
        return 1740;
    }
}