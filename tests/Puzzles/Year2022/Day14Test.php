<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day14;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day14::class)]
class Day14Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 24],
            [1, 2, 93],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 805;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 25161;
    }
}
