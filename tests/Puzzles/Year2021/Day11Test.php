<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day11;
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
            [1, 1, 1656],
            [1, 2, 195],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1721;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 298;
    }
}
