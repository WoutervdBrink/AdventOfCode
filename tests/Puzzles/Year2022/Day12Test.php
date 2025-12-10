<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day12;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day12::class)]
class Day12Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 31],
            [1, 2, 29],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 380;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 375;
    }
}
