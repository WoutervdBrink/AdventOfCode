<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2023;

use Knevelina\AdventOfCode\Puzzles\Year2023\Day03;
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
            [1, 1, 4361],
            [1, 2, 467835],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 530849;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 84900879;
    }
}
