<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day19
 */
class Day19Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [2, 1, 3],
            [2, 2, 12]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 120;
    }

    public function getSolutionForPart2(): int
    {
        return 350;
    }
}