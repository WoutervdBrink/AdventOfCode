<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 142],
            [2, 2, 281],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 54990;
    }

    public function getSolutionForPart2(): int
    {
        return 54473;
    }
}