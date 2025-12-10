<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day07;
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
            [1, 1, 21],
            [1, 2, 40],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1628;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 27055852018812;
    }
}
