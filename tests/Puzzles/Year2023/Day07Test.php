<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day07;
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
            [1, 1, 6440],
            [1, 2, 5905],
            [2, 2, 5911],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 249748283;
    }
}
