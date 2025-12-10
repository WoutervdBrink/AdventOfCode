<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day07;
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
            [1, 1, 95437],
            [1, 2, 24933642],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1908462;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 3979145;
    }
}
