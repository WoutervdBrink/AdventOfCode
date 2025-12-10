<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day14;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day14::class)]
class Day14Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 165],
            [2, 2, 208],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 11926135976176;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 4330547254348;
    }
}
