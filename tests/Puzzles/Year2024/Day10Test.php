<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day10
 */
class Day10Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 36],
            [1, 2, 81],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 841;
    }

    public function getSolutionForPart2(): int
    {
        return 1875;
    }
}