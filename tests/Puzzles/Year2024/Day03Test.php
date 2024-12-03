<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 161],
            [2, 2, 48],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 166905464;
    }

    public function getSolutionForPart2(): int
    {
        return 72948684;
    }
}