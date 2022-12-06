<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day06
 */
class Day06Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 7],
            [2, 1, 5],
            [3, 1, 6],
            [4, 1, 10],
            [5, 1, 11],

            [1, 2, 19],
            [2, 2, 23],
            [3, 2, 23],
            [4, 2, 29],
            [5, 2, 26],
        ];
    }
}