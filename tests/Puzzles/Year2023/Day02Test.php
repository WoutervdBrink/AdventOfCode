<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day02;
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
            [1, 1, 8],
            [1, 2, 2286],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 2369;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 66363;
    }
}
