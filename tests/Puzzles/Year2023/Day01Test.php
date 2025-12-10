<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day01;
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
            [1, 1, 142],
            [2, 2, 281],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 54990;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 54473;
    }
}
