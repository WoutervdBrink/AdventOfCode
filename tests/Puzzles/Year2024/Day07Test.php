<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day07;
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
            [1, 1, 3749],
            [1, 2, 11387],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 5512534574980;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 328790210468594;
    }
}
