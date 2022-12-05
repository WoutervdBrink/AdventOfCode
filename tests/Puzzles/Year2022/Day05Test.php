<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2022\Day05
 */
class Day05Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 'CMZ'],
            [1, 2, 'MCD'],
        ];
    }

    public function getSolutionForPart1(): string
    {
        return 'CWMTGHBDW';
    }

    public function getSolutionForPart2(): string
    {
        return 'SSCGWJCRB';
    }
}