<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day05;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day05::class)]
class Day05Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 35],
            [1, 2, 46],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 457535844;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 41222968;
    }
}
