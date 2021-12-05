<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day04
 */
class Day04Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 4512],
            [1, 2, 1924]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 58374;
    }
}