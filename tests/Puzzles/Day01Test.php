<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 514579],
            [1, 2, 241861950]
        ];
    }

    public function getSolutionForPart1()
    {
        return 542619;
    }

    public function getSolutionForPart2()
    {
        return 32858450;
    }
}
