<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day14
 */
class Day14Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 165],
            [2, 2, 208]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 11926135976176;
    }

    public function getSolutionForPart2(): int
    {
        return 4330547254348;
    }
}