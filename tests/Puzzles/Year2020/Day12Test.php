<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day12
 */
class Day12Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 25],
            [1, 2, 286]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 2847;
    }

    public function getSolutionForPart2(): int
    {
        return 29839;
    }
}