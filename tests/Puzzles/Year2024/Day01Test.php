<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2024;

use Knevelina\AdventOfCode\Puzzles\Year2024\Day01;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day01::class)]
class Day01Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 11],
            [1, 2, 31],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1834060;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 21607792;
    }
}
