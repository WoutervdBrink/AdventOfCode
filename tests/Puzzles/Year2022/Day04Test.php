<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
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
        return 464;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 770;
    }
}
