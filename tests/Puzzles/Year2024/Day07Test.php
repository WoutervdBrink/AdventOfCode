<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 3749],
            [1, 2, 11387],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 5512534574980;
    }

    public function getSolutionForPart2(): int
    {
        return 328790210468594;
    }
}