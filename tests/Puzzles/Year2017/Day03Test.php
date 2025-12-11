<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day03;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day03::class)]
class Day03Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 0],
            [2, 1, 3],
            [3, 1, 2],
            [4, 1, 31],
            [5, 1, 4],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 419;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 295229;
    }
}
