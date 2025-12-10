<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day09;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day09::class)]
class Day09Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 1928],
            [1, 2, 2858],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 6242766523059;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 6272188244509;
    }
}
