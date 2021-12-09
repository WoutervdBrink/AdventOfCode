<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day09
 */
class Day09Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 15],
            [1, 2, 1134]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 631;
    }

    public function getSolutionForPart2(): string|int|float|null
    {
        return 821560;
    }
}