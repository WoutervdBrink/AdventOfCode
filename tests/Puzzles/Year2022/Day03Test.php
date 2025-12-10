<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day03;
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
            [1, 1, 157],
            [1, 2, 70],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 7597;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 2607;
    }
}
