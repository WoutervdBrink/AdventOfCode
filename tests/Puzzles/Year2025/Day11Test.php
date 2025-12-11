<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day11;
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
            [1, 1, 5],
            [2, 2, 2],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 758;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 490695961032000;
    }
}
