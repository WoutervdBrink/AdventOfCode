<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day07;
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
            [1, 1, 4],
            [1, 2, 32],
            [2, 2, 126],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 211;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 12414;
    }
}
