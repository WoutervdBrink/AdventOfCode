<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day18
 */
class Day18Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 71],
            [2, 1, 51],
            [3, 1, 26],
            [4, 1, 437],
            [5, 1, 12240],
            [6, 1, 13632],

            [1, 2, 231],
            [2, 2, 51],
            [3, 2, 46],
            [4, 2, 1445],
            [5, 2, 669060],
            [6, 2, 23340]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 14208061823964;
    }

    public function getSolutionForPart2(): int
    {
        return 320536571743074;
    }
}