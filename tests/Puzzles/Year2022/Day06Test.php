<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day06;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day06::class)]
class Day06Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 7],
            [2, 1, 5],
            [3, 1, 6],
            [4, 1, 10],
            [5, 1, 11],

            [1, 2, 19],
            [2, 2, 23],
            [3, 2, 23],
            [4, 2, 29],
            [5, 2, 26],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1080;
    }

    public function getSolutionForPart2(): int
    {
        return 3645;
    }
}
