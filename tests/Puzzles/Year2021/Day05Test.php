<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 5],
            [1, 2, 12]
        ];
    }

    public function getSolutionForPart1(): string|int|null
    {
        return 6311;
    }

    public function getSolutionForPart2(): string|int|null
    {
        return 19929;
    }
}