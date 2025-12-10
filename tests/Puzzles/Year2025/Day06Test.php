<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day06;
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
            [1, 1, 4277556],
            [1, 2, 3263827],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 6725216329103;
    }

    public function getSolutionForPart2(): int
    {
        return 10600728112865;
    }
}
