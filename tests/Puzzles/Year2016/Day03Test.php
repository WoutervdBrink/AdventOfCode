<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day03;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day03::class)]
class Day03Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 0],
            [2, 2, 6],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1032;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1838;
    }
}
