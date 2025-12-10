<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day01;
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
            [1, 1, 24000],
            [1, 2, 45000],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 71502;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 208191;
    }
}
