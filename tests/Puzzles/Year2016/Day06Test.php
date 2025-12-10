<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day06;
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
            [1, 1, 'easter'],
            [1, 2, 'advent'],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): string
    {
        return 'asvcbhvg';
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return 'odqnikqv';
    }
}
