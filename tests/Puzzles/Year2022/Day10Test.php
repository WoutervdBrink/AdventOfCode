<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day10
 */
class Day10Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 13140],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 15220;
    }

    public function getSolutionForPart2(): string
    {
        return 'RFZEKBFA';
    }
}