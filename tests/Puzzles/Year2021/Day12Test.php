<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day12
 */
class Day12Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 10],
            [2, 1, 19],
            [3, 1, 226],

            [1, 2, 36],
            [2, 2, 103],
            [3, 2, 3509]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 5076;
    }

    public function getSolutionForPart2(): int
    {
        return 145643;
    }
}