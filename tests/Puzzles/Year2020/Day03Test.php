<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 7],
            [1, 2, 336]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 164;
    }

    public function getSolutionForPart2(): int
    {
        return 5007658656;
    }
}