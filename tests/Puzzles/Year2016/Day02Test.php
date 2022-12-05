<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2016\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, '1985'],
            [1, 2, '5DB3']
        ];
    }

    public function getSolutionForPart1(): string
    {
        return '47978';
    }

    public function getSolutionForPart2(): string
    {
        return '659AD';
    }
}