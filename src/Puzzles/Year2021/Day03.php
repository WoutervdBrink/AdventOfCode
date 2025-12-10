<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day03 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): float
    {
        $input = InputManipulator::splitLines($input);
        $counter = array_fill(0, strlen($input[0]), 0);

        foreach ($input as $line) {
            for ($i = 0; $i < strlen($line); $i++) {
                if ($line[$i] === '1') {
                    $counter[$i]++;
                }
            }
        }

        $gamma = 0;
        $epsilon = 0;

        for ($i = count($counter) - 1; $i >= 0; $i--) {
            $pow = count($counter) - $i - 1;
            if ($counter[$i] > count($input) / 2) {
                $gamma += pow(2, $pow);
            } else {
                $epsilon += pow(2, $pow);
            }
        }

        return $gamma * $epsilon;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);

        $oxygen = self::findOxygenGeneratorRating($input);
        $co2 = self::findCO2ScrubberRating($input);

        return $oxygen * $co2;
    }

    private static function findOxygenGeneratorRating(array $lines): int
    {
        return self::findRating($lines, 0, fn (array $zeroCandidates, array $oneCandidates): array => match (true) {
            count($zeroCandidates) > count($oneCandidates) => $zeroCandidates,

            default => $oneCandidates
        });
    }

    private static function findRating(array $lines, int $index, callable $candidateDecider): int
    {
        [$zeroCandidates, $oneCandidates] = self::findZeroAndOneCandidates($lines, $index);

        $candidates = $candidateDecider($zeroCandidates, $oneCandidates);

        if (count($candidates) === 1) {
            return (int) bindec($candidates[0]);
        }

        return self::findRating($candidates, $index + 1, $candidateDecider);
    }

    /**
     * @return array[]
     */
    private static function findZeroAndOneCandidates(array $lines, int $index): array
    {
        if ($index >= strlen($lines[0])) {
            throw new RuntimeException(
                sprintf(
                    'Could not find zero and one candidates: index %d exceeds line length %d',
                    $index,
                    strlen($lines[0])
                )
            );
        }

        $zeroCandidates = [];
        $oneCandidates = [];

        foreach ($lines as $line) {
            if ($line[$index] === '1') {
                $oneCandidates[] = $line;
            } else {
                $zeroCandidates[] = $line;
            }
        }

        return [$zeroCandidates, $oneCandidates];
    }

    private static function findCO2ScrubberRating(array $lines): int
    {
        return self::findRating($lines, 0, fn (array $zeroCandidates, array $oneCandidates): array => match (true) {
            count($zeroCandidates) > count($oneCandidates) => $oneCandidates,

            default => $zeroCandidates
        });
    }
}
