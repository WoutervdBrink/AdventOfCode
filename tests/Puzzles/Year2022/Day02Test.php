<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day02;
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
            [1, 1, 15],
            [1, 2, 12],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 11150;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 8295;
    }
}
