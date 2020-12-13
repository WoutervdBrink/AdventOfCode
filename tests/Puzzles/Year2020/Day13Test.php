<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day13
 */
class Day13Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 295],
            [1, 2, 1068781],
            [2, 2, 3417],
            [3, 2, 754018],
            [4, 2, 779210],
            [5, 2, 1261476],
            [6, 2, 1202161486]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 4808;
    }

    public function getSolutionForPart2(): int
    {
        return 741745043105674;
    }
}