<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day09;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day09::class)]
class Day09Test extends PuzzleSolverTestCase
{
    #[Override]
    public function it_solves_an_example(int $example, int $part, string|int $expected): void
    {
        // Has no examples...
        $this->assertTrue(true);
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1212510616;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 171265123;
    }

    #[Override]
    public static function getExamples(): array
    {
        return [];
    }
}
