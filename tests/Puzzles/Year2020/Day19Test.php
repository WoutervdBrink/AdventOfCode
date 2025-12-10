<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day19;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day19::class)]
class Day19Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 2],
            [2, 1, 3],
            [2, 2, 12],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 120;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 350;
    }
}
