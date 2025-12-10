<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day04;
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
            [1, 1, 4],
            [2, 1, 18],
            [3, 2, 1],
            [2, 2, 9],
            [4, 1, 2358],
            [4, 2, 1737],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 2507;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1969;
    }
}
