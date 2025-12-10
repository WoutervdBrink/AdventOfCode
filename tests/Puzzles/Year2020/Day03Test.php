<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day03;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day03::class)]
class Day03Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 7],
            [1, 2, 336],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 164;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 5007658656;
    }
}
