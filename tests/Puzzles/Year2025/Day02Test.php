<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2025\Day02
 */
class Day02Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 1227775554],
            [1, 2, 4174379265],
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 18952700150;
    }

    public function getSolutionForPart2(): int
    {
        return 28858486244;
    }
}