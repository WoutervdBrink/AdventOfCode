<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day06;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day06::class)]
class Day06Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 5934],
            [1, 2, 26984457539],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 352151;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1601616884019;
    }
}
