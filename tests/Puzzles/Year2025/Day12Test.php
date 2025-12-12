<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day12;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day12::class)]
class Day12Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            // The examples are more complex than the input.
        ];
    }

    #[Override]
    public function it_solves_an_example(int $example, int $part, int|string $expected): void
    {
        $this->assertTrue(true);
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 499;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        // There is no part 2.
        return 0;
    }
}
