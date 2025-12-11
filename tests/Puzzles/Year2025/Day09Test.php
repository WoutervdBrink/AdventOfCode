<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day09;
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
            [1, 1, 50],
            [1, 2, 24],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 4758598740;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1474699155;
    }
}
