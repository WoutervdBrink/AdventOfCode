<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day09;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day09::class)]
class Day09Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 13],
            [1, 2, 1],
            [2, 1, 88],
            [2, 2, 36],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 5780;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 2331;
    }
}
