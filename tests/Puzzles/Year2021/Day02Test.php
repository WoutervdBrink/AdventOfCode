<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day02;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day02::class)]
class Day02Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 150],
            [1, 2, 900],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1989014;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 2006917119;
    }
}
