<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day13
 */
class Day13Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 330]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 733;
    }

    public function getSolutionForPart2(): int
    {
        return 725;
    }
}