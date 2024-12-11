<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day11
 */
class Day11Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 55312],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 203609;
    }

    public function getSolutionForPart2(): int
    {
        return 240954878211138;
    }
}