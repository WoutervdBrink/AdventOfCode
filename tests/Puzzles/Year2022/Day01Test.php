<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 24000],
            [1, 2, 45000]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 71502;
    }

    public function getSolutionForPart2(): int
    {
        return 208191;
    }
}