<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 35],
            [1, 2, 46],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 457535844;
    }

    public function getSolutionForPart2(): int
    {
        return 41222968;
    }
}