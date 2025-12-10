<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Puzzles\Year2017\Day01;
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
            [1, 1, 3],
            [2, 1, 4],
            [3, 1, 0],
            [4, 1, 9],

            [5, 2, 6],
            [6, 2, 0],
            [7, 2, 4],
            [8, 2, 12],
            [9, 2, 4],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1141;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 950;
    }
}
