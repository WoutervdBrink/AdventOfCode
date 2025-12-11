<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 2],
        ];
    }
}
