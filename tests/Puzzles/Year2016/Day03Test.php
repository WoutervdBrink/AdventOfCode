<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 0],
            [2, 2, 6],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1032;
    }

    public function getSolutionForPart2(): int
    {
        return 1838;
    }
}