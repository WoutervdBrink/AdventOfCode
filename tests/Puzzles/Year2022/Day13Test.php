<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day13
 */
class Day13Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 13],
            [1, 2, 140],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 5208;
    }

    public function getSolutionForPart2(): int
    {
        return 25792;
    }
}