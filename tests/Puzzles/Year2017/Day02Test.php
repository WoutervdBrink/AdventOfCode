<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2017\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 18],
            [2, 2, 9],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 36766;
    }

    public function getSolutionForPart2(): int
    {
        return 261;
    }
}