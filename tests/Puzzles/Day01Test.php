<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Day01
 * @package Knevelina\AdventOfCode\Tests\Puzzles
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 514579],
            [1, 2, 241861950]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 542619;
    }

    /**
     * @return int
     */
    public function getSolutionForPart2(): int
    {
        return 32858450;
    }
}
