<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day03;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day03::class)]
class Day03Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 198],
            [1, 2, 230],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 3429254;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 5410338;
    }
}
