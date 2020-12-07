<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 609043],
            [2, 1, 1048970]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 254575;
    }

    public function getSolutionForPart2(): int
    {
        return 1038736;
    }
}