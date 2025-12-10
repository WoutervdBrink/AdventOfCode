<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2021;

use Knevelina\AdventOfCode\Puzzles\Year2021\Day10;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day10::class)]
class Day10Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 26397],
            [1, 2, 288957],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 339477;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 3049320156;
    }
}
