<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day06;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day06::class)]
class Day06Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 41],
            [1, 2, 6],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 4964;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1740;
    }
}
