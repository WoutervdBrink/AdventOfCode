<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2025\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 3],
            [1, 2, 6],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1040;
    }

    public function getSolutionForPart2(): int
    {
        return 6027;
    }
}