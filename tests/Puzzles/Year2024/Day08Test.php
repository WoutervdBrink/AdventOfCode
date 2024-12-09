<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day08
 */
class Day08Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 14],
            [2, 1, 4],
            [1, 2, 34],
            [3, 2, 9],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 228;
    }

    public function getSolutionForPart2(): int
    {
        return 766;
    }
}