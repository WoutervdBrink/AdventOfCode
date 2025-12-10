<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day15;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day15::class)]
class Day15Test extends PuzzleSolverTestCase
{
    public static function getExamples(): array
    {
        return [
            [1, 1, 26],
            // [1, 2, 56000011],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 5525990;
    }
}
