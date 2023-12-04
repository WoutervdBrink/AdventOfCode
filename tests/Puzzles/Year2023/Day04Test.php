<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 13],
            [1, 2, 30],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 32609;
    }

    public function getSolutionForPart2(): int
    {
        return 14624680;
    }
}