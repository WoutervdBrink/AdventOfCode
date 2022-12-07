<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day08
 */
class Day08Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 6],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 119;
    }

    public function getSolutionForPart2(): string
    {
        return 'ZFHFSFOGPO';
    }
}