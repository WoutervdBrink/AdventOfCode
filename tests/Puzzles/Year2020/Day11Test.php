<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2020;

use Knevelina\AdventOfCode\Puzzles\Year2020\Day11;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day11::class)]
class Day11Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 37],
            [1, 2, 26],
        ];
    }

    // Takes ages
    //    public function getSolutionForPart1(): int
    //    {
    //        return 2481;
    //    }
    //
    //    public function getSolutionForPart2(): int
    //    {
    //        return 2227;
    //    }
}
