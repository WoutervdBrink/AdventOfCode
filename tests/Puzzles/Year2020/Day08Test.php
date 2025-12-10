<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day08;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day08::class)]
class Day08Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 5],
            [1, 2, 8],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1489;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1539;
    }
}
