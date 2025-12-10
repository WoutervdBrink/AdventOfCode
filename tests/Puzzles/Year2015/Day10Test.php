<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day10;
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
            [1, 1, 82350],
            [2, 1, 100230],
            [3, 1, 220294],
            [4, 1, 152768],
            [5, 1, 274140],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 360154;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 5103798;
    }
}
