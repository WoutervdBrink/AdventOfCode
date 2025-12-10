<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day01;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day01::class)]
class Day01Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 3],
            [1, 2, 6],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1040;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 6027;
    }
}
