<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 150],
            [1, 2, 900]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 1989014;
    }

    public function getSolutionForPart2(): int|null
    {
        return 2006917119;
    }
}