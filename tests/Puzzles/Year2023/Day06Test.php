<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day06;
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
            [1, 1, 288],
            [1, 2, 71503],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 741000;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 38220708;
    }
}
