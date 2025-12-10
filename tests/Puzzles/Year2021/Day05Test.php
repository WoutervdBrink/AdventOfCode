<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day05;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day05::class)]
class Day05Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 5],
            [1, 2, 12],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 6311;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 19929;
    }
}
