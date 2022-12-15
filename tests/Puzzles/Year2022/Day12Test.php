<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day12
 */
class Day12Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 31],
            [1, 2, 29],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 380;
    }

    public function getSolutionForPart2(): int
    {
        return 375;
    }
}