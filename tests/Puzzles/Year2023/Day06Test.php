<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day06
 */
class Day06Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 288],
            [1, 2, 71503],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 741000;
    }

    public function getSolutionForPart2(): int
    {
        return 38220708;
    }
}