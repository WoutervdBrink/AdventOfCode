<?php

namespace Knevelina\AdventOfCode;

use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;

/**
 * Output of a puzzle solver that solves both parts in one execution.
 *
 * @see CombinedPuzzleSolver
 */
readonly class CombinedPuzzleOutput
{
    private function __construct(
        /**
         * @var int|float|string The solution of the first part.
         */
        private int|float|string $part1,

        /**
         * @var int|float|string The solution of the second part.
         */
        private int|float|string $part2,
    )
    {
    }

    /**
     * Construct a new instance with the specified solutions for part 1 and part 2.
     *
     * @param int|float|string $part1 The solution of the first part.
     * @param int|float|string $part2 The solution of the second part.
     * @return self
     */
    public static function of(int|float|string $part1, int|float|string $part2): self
    {
        return new self($part1, $part2);
    }

    /**
     * Get the solution of the first part.
     *
     * @return int|float|string
     */
    public function part1(): int|float|string
    {
        return $this->part1;
    }

    /**
     * Get the solution of the second part.
     *
     * @return int|float|string
     */
    public function part2(): int|float|string
    {
        return $this->part2;
    }
}