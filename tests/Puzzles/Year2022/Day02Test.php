<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 15],
            [1, 2, 12]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 11150;
    }

    public function getSolutionForPart2(): int
    {
        return 8295;
    }
}