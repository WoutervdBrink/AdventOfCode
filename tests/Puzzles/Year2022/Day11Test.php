<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day11
 */
class Day11Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 10605],
            [1, 2, 2713310158],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 118674;
    }

    public function getSolutionForPart2(): int
    {
        return 32333418600;
    }
}