<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day02;
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
            [1, 2, 4],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 463;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 514;
    }
}
