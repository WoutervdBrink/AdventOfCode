<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day07 implements PuzzleSolver
{
    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): array {
            preg_match_all('/\[?[a-z]+]?+/', $line, $matches);

            if (count($matches) === 0) {
                return [];
            }

            return $matches[0];
        });
    }

    protected static function containsAbba(string $string): bool
    {
        for ($i = 0; $i < strlen($string) - 3; $i++) {
            if ($string[$i] === $string[$i + 1]) {
                continue;
            }

            if ($string[$i] !== $string[$i + 3]) {
                continue;
            }

            if ($string[$i + 1] !== $string[$i + 2]) {
                continue;
            }

            return true;
        }

        return false;
    }

    protected static function getAbas(string $string): array
    {
        $abas = [];

        for ($i = 0; $i < strlen($string) - 2; $i++) {
            if ($string[$i] === $string[$i + 1]) {
                continue;
            }

            if ($string[$i] !== $string[$i + 2]) {
                continue;
            }

            $abas[] = substr($string, $i, 3);
        }

        return $abas;
    }

    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        $input = array_filter($input, function (array $address): bool {
            $hasLegalAbba = false;

            foreach ($address as $part) {
                if ($part[0] === '[') {
                    if (self::containsAbba(substr($part, 1, -1))) {
                        return false;
                    }
                } else {
                    $hasLegalAbba = self::containsAbba($part) || $hasLegalAbba;
                }
            }

            return $hasLegalAbba;
        });

        return count($input);
    }

    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        $input = array_filter($input, function (array $address): bool {
            $abas = array_reduce(
                $address,
                function (array $abas, string $part): array {
                    if ($part[0] === '[') {
                        return $abas;
                    }

                    $abas = array_merge($abas, self::getAbas($part));
                    return $abas;
                },
                []
            );

            foreach ($abas as $aba) {
                foreach ($address as $part) {
                    if ($part[0] !== '[') {
                        continue;
                    }

                    $part = substr($part, 1, -1);

                    if (str_contains($part, $aba[1] . $aba[0] . $aba[1])) {
                        return true;
                    }
                }
            }

            return false;
        });

        return count($input);
    }
}