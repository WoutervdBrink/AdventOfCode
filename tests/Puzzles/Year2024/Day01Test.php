<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2024\Day01
 */
class Day01Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 11],
            [1, 2, 31],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1834060;
    }

    public function getSolutionForPart2(): int
    {
        return 21607792;
    }
}