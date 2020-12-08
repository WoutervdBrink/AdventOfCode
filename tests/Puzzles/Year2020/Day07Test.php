<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 4],
            [1, 2, 32],
            [2, 2, 126]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 211;
    }

    public function getSolutionForPart2(): int|null
    {
        return 12414;
    }
}