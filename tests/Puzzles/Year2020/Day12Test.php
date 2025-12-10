<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day12;
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
            [1, 1, 25],
            [1, 2, 286],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 2847;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 29839;
    }
}
