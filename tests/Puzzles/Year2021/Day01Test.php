<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day01;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day01::class)]
class Day01Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 7],
            [1, 2, 5],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1624;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1653;
    }
}
