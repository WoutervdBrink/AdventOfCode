<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day06
 */
class Day06Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 'easter'],
            [1, 2, 'advent'],
        ];
    }

    public function getSolutionForPart1(): string
    {
        return 'asvcbhvg';
    }

    public function getSolutionForPart2(): string
    {
        return 'odqnikqv';
    }
}