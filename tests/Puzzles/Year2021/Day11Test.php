<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day11
 */
class Day11Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1656],
            [1, 2, 195],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1721;
    }

    public function getSolutionForPart2(): int
    {
        return 298;
    }
}