<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day05 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $nice = 0;

        foreach ($input as $word) {
            if (! static::containsThreeVowels($word)) {
                continue;
            }

            if (! static::containsTwoConsecutiveLetters($word)) {
                continue;
            }

            if (self::containsForbiddenStrings($word)) {
                continue;
            }

            $nice++;
        }

        return $nice;
    }

    private static function containsThreeVowels(string $word): bool
    {
        return strlen($word) - strlen(preg_replace('/[aeiou]/', '', $word)) >= 3;
    }

    private static function containsTwoConsecutiveLetters(string $word): bool
    {
        foreach (range('a', 'z') as $letter) {
            if (str_contains($word, $letter.$letter)) {
                return true;
            }
        }

        return false;
    }

    private static function containsForbiddenStrings(string $word): bool
    {
        foreach (['ab', 'cd', 'pq', 'xy'] as $string) {
            if (str_contains($word, $string)) {
                return true;
            }
        }

        return false;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $nice = 0;

        foreach ($input as $word) {
            if (! self::containsNonOverlappingRepeatingPair($word)) {
                continue;
            }

            if (! self::containsRepeatingletterWithInterleavingLetter($word)) {
                continue;
            }

            $nice++;
        }

        return $nice;
    }

    private static function containsNonOverlappingRepeatingPair(string $word): bool
    {
        foreach (range('a', 'z') as $a) {
            foreach (range('a', 'z') as $b) {
                $pair = $a.$b;
                if (preg_match('/'.$pair.'.*'.$pair.'/', $word)) {
                    return true;
                }
            }
        }

        return false;
    }

    private static function containsRepeatingletterWithInterleavingLetter(string $word): bool
    {
        foreach (range('a', 'z') as $letter) {
            if (preg_match('/'.$letter.'.'.$letter.'/', $word)) {
                return true;
            }
        }

        return false;
    }
}
