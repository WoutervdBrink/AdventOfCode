<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day05;
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
            [1, 1, 1],
            [2, 1, 1],
            [3, 1, 0],
            [4, 1, 0],
            [5, 1, 0],

            [6, 2, 1],
            [7, 2, 1],
            [8, 2, 0],
            [9, 2, 0],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 236;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 51;
    }
}
