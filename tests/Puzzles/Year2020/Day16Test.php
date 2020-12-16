<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day16
 */
class Day16Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 71]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 27850;
    }

    public function getSolutionForPart2(): int|null
    {
        return 491924517533;
    }
}