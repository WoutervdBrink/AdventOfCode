<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 609043],
            [2, 1, 1048970],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 254575;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 1038736;
    }
}
