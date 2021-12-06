<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day06;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day06
 */
class Day06Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 5934],
            [1, 2, 26984457539]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 352151;
    }

    public function getSolutionForPart2(): int
    {
        return 1601616884019;
    }
}