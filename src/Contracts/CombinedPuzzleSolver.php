<?php

namespace Knevelina\AdventOfCode\Contracts;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;

/**
 * Solves an Advent of Code puzzle for one specific day.
 *
 * This special kind of solver solves both parts in one go.
 *
 * @see CombinedPuzzleOutput
 */
abstract class CombinedPuzzleSolver implements PuzzleSolver
{
    private ?int $inputHash;
    private ?CombinedPuzzleOutput $result;

    private function solveIfNeeded(string $input): void {
        $hash = crc32($input);

        if (empty($this->result) || $hash !== $this->inputHash) {
            $this->result = $this->solve($input);
            $this->inputHash = $hash;
        }
    }


    protected abstract function solve(string $input): CombinedPuzzleOutput;

    public function part1(string $input): string|int|float
    {
        $this->solveIfNeeded($input);
        return $this->result->part1();
    }

    public function part2(string $input): string|int|float
    {
        $this->solveIfNeeded($input);
        return $this->result->part2();
    }
}