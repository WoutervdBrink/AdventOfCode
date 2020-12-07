<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [1, 2, 1]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 586;
    }

    public function getSolutionForPart2(): int
    {
        return 352;
    }
}