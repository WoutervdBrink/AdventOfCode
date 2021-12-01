<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 7],
            [1, 2, 5]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 1624;
    }

    public function getSolutionForPart2(): int|null
    {
        return 1653;
    }
}