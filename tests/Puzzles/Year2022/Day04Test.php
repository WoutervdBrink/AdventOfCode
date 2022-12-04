<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [1, 2, 4],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 464;
    }

    public function getSolutionForPart2(): int
    {
        return 770;
    }
}