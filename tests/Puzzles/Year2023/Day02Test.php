<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 8],
            [1, 2, 2286],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 2369;
    }

    public function getSolutionForPart2(): int
    {
        return 66363;
    }
}