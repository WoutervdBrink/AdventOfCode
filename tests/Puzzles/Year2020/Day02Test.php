<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day02;
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
            [1, 1, 2],
            [1, 2, 1],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 586;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 352;
    }
}
