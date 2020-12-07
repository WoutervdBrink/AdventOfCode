<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [2, 1, 4],
            [3, 1, 2],

            [4, 2, 3],
            [2, 2, 3],
            [3, 2, 11]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 2565;
    }

    public function getSolutionForPart2(): int
    {
        return 2639;
    }
}