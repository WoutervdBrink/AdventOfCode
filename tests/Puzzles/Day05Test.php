<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day05Test extends PuzzleSolverTestCase
{

    /**
     * @return int[][]
     */
    public function getExamples(): array
    {
        return [
            [1, 1, 357]
        ];
    }

    /**
     * @return int
     */
    public function getSolutionForPart1(): int
    {
        return 878;
    }

    /**
     * @return int
     */
    public function getSolutionForPart2(): int
    {
        return 504;
    }
}