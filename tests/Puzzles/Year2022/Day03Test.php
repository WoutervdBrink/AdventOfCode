<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 157],
            [1, 2, 70],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 7597;
    }

    public function getSolutionForPart2(): int
    {
        return 2607;
    }
}