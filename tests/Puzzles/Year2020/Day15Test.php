<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day15;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day15::class)]
class Day15Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 10],
            [3, 1, 27],
            [4, 1, 78],
            [5, 1, 438],
            [6, 1, 1836],
            [7, 1, 436],

            // Slow
            [1, 2, 2578],
            [2, 2, 3544142],
            [3, 2, 261214],
            [4, 2, 6895259],
            [5, 2, 18],
            [6, 2, 362],
            [7, 2, 175594],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 410;
    }

    // Slow
    #[Override]
    public function getSolutionForPart2(): int
    {
        return 238;
    }
}
