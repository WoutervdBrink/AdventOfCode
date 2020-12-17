<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day07
 */
class Day07Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 65079]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 956;
    }

    public function getSolutionForPart2(): int|null
    {
        return 40149;
    }
}