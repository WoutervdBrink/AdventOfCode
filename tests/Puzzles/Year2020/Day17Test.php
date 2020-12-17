<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day17
 */
class Day17Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 112],
            [1, 2, 848]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 333;
    }

    public function getSolutionForPart2(): int
    {
        return 2676;
    }
}