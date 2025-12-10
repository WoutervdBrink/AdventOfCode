<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day05;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day05::class)]
class Day05Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 143],
            [1, 2, 123],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 6034;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 6305;
    }
}
