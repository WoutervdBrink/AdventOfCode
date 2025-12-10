<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day06;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day06::class)]
class Day06Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 4],
            [2, 2, 2000000],
        ];
    }

    // At the moment, the implementation is very slow and thus not included in the test suite.
    // Feel free to include these tests if another day uses the lights system.
    //    public function getSolutionForPart1(): int
    //    {
    //        return 400410;
    //    }
    //
    //    public function getSolutionForPart2(): int
    //    {
    //        return 15343601;
    //    }
}
