<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2025;

use Knevelina\AdventOfCode\Puzzles\Year2025\Day02;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day02::class)]
class Day02Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 1227775554],
            [1, 2, 4174379265],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 18952700150;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 28858486244;
    }
}
