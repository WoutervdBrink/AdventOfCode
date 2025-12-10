<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day10;
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
            [1, 1, 35],
            [2, 1, 220],

            [1, 2, 8],
            [2, 2, 19208],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 2046;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1157018619904;
    }
}
