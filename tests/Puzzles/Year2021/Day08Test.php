<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day08;
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
            [1, 1, 26],
            [1, 2, 61229],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 456;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1091609;
    }
}
