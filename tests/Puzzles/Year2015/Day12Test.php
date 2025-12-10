<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day12;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day12::class)]
class Day12Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 6],
            [2, 1, 6],
            [3, 1, 3],
            [4, 1, 3],
            [5, 1, 0],
            [6, 1, 0],
            [7, 1, 0],
            [8, 1, 0],

            [1, 2, 6],
            [9, 2, 4],
            [10, 2, 0],
            [11, 2, 6],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 111754;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 65402;
    }
}
