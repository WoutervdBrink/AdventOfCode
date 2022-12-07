<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 95437],
            [1, 2, 24933642],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1908462;
    }

    public function getSolutionForPart2(): int
    {
        return 3979145;
    }
}