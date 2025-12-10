<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day07;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day07::class)]
class Day07Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 37],
            [1, 2, 168],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): float
    {
        return 344735;
    }

    #[Override]
    public function getSolutionForPart2(): float
    {
        return 96798233;
    }
}
