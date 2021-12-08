<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day08
 */
class Day08Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 26],
            [1, 2, 61229]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 456;
    }

    public function getSolutionForPart2(): int
    {
        return 1091609;
    }
}