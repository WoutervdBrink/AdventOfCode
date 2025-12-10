<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day11;
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
            [1, 1, 55312],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 203609;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 240954878211138;
    }
}
