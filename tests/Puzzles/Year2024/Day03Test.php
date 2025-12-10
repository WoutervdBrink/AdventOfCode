<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day03;
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
            [1, 1, 161],
            [2, 2, 48],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 166905464;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 72948684;
    }
}
