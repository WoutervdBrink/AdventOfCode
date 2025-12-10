<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day16;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day16::class)]
class Day16Test extends PuzzleSolverTestCase
{
    public static function getExamples(): array
    {
        return [
            [1, 1, 71],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 27850;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 491924517533;
    }
}
