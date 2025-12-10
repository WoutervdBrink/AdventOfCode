<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day11;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day11::class)]
class Day11Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 10605],
            [1, 2, 2713310158],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 118674;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 32333418600;
    }
}
