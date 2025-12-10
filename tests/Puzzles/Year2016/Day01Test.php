<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day01;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day01::class)]
class Day01Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 5],
            [2, 1, 2],
            [3, 1, 12],
            [4, 2, 4],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 262;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 131;
    }
}
