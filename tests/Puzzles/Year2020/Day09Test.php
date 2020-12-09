<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day09
 */
class Day09Test extends PuzzleSolverTestCase
{
    public function it_solves_an_example(int $example, int $part, int $expected): void
    {
        // Has no examples...
        $this->assertTrue(true);
    }

    public function getSolutionForPart1(): int
    {
        return 1212510616;
    }

    public function getSolutionForPart2(): int
    {
        return 171265123;
    }

    public function getExamples(): array
    {
        return [];
    }
}