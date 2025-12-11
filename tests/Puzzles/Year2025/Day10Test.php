<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day10;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day10::class)]
class Day10Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 7],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 461;
    }
}
