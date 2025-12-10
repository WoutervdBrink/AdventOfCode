<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day08;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day08::class)]
class Day08Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 40],
            [1, 2, 25272],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 164475;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 169521198;
    }
}
