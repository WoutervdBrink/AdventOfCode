<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day09
 */
class Day09Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 605],
            [1, 2, 982]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 141;
    }

    public function getSolutionForPart2(): int|null
    {
        return 736;
    }
}