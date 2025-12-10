<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day08;
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
            [1, 1, 14],
            [2, 1, 4],
            [1, 2, 34],
            [3, 2, 9],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 228;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 766;
    }
}
