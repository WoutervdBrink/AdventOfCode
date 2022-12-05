<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1514],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 185371;
    }

    public function getSolutionForPart2(): int
    {
        return 984;
    }
}