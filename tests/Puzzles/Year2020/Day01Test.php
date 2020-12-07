<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 514579],
            [1, 2, 241861950]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 542619;
    }

    public function getSolutionForPart2(): int
    {
        return 32858450;
    }
}
