<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day05;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day05::class)]
class Day05Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 3],
            [1, 2, 14],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 782;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 353863745078671;
    }
}
