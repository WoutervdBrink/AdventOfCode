<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2017;

use Knevelina\AdventOfCode\Puzzles\Year2017\Day02;
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
            [1, 1, 18],
            [2, 2, 9],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 36766;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 261;
    }
}
