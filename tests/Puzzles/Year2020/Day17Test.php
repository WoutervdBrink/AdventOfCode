<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day17;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day17::class)]
class Day17Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 112],
            [1, 2, 848],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 333;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 2676;
    }
}
