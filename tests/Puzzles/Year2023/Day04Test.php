<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 13],
            [1, 2, 30],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 32609;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 14624680;
    }
}
