<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [2, 2, 0],
            [3, 2, 4]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 256;
    }

    public function getSolutionForPart2(): int
    {
        return 198;
    }
}