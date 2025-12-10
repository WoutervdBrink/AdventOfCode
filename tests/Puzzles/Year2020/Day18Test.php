<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day18;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day18::class)]
class Day18Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 71],
            [2, 1, 51],
            [3, 1, 26],
            [4, 1, 437],
            [5, 1, 12240],
            [6, 1, 13632],

            [1, 2, 231],
            [2, 2, 51],
            [3, 2, 46],
            [4, 2, 1445],
            [5, 2, 669060],
            [6, 2, 23340],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 14208061823964;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 320536571743074;
    }
}
