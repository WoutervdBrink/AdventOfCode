<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day10
 */
class Day10Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 26397],
            [1, 2, 288957]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 339477;
    }

    public function getSolutionForPart2(): int
    {
        return 3049320156;
    }
}