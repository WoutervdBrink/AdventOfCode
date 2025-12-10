<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 2],
            [2, 2, 0],
            [3, 2, 4],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 256;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 198;
    }
}
