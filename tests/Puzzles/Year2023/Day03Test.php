<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2023\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 4361],
            [1, 2, 467835],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 530849;
    }

    public function getSolutionForPart2(): int
    {
        return 84900879;
    }
}