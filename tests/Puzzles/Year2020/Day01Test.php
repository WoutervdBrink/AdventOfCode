<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day01;
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
            [1, 1, 514579],
            [1, 2, 241861950],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 542619;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 32858450;
    }
}
