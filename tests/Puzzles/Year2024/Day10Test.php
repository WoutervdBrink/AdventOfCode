<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day10;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day10::class)]
class Day10Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 36],
            [1, 2, 81],
            [2, 1, 464],
            [2, 2, 16451],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 841;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1875;
    }
}
