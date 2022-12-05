<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, '18f47a30'],
            [1, 2, '05ace8e3'],
        ];
    }

    public function getSolutionForPart1(): string
    {
        return 'f97c354d';
    }

    public function getSolutionForPart2(): string
    {
        return '863dde27';
    }
}