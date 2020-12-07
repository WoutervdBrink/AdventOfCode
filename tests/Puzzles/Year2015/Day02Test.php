<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 58],
            [2, 1, 43],

            [1, 2, 34],
            [2, 2, 14]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1606483;
    }

    public function getSolutionForPart2(): int
    {
        return 3842356;
    }
}