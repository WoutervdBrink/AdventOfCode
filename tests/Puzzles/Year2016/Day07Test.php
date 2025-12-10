<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day07;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day07::class)]
class Day07Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 0],
            [3, 1, 0],
            [4, 1, 1],

            [5, 2, 1],
            [6, 2, 0],
            [7, 2, 1],
            [8, 2, 1],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 110;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 242;
    }
}
