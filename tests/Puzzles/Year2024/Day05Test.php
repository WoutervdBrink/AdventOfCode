<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 143],
            [1, 2, 123],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 6034;
    }

    public function getSolutionForPart2(): int
    {
        return 6305;
    }
}