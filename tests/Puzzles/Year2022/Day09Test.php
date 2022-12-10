<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day09
 */
class Day09Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 13],
            [1, 2, 1],
            [2, 1, 88],
            [2, 2, 36],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 5780;
    }

    public function getSolutionForPart2(): int
    {
        return 2331;
    }
}