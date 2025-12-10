<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day04;
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
            [1, 1, 4512],
            [1, 2, 1924],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 58374;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 11377;
    }
}
