<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day09
 */
class Day09Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1928],
            [1, 2, 2858],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 6242766523059;
    }

    public function getSolutionForPart2(): int
    {
        return 6272188244509;
    }
}