<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2025\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 357],
            [1, 2, 3121910778619],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 17311;
    }

    public function getSolutionForPart2(): int
    {
        return 171419245422055;
    }
}