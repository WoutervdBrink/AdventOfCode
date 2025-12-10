<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day03;
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
            [1, 1, 357],
            [1, 2, 3121910778619],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 17311;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 171419245422055;
    }
}
