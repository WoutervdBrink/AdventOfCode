<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2021\Day03
 */
class Day03Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 198],
            [1, 2, 230]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 3429254;
    }

    public function getSolutionForPart2(): int|null
    {
        return 5410338;
    }
}