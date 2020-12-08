<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2020\Day08
 */
class Day08Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 5],
            [1, 2, 8]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 1489;
    }

    public function getSolutionForPart2(): int
    {
        return 1539;
    }
}