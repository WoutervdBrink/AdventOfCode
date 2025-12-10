<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day13;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day13::class)]
class Day13Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 330],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 733;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 725;
    }
}
