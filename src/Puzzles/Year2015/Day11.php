<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day11 implements PuzzleSolver
{
    public static function encodePassword(string $password): array
    {
        return array_map(fn (string $char): int => ord($char) - 97, str_split($password));
    }

    public static function decodePassword(array $password): string
    {
        return implode('', array_map(fn (int $char): string => chr($char + 97), $password));
    }

    public static function nextPassword(array $password): array
    {
        $carry = 1;

        for ($i = count($password) - 1; $i >= 0; $i--) {
            $password[$i] += $carry;

            $carry = 0;
            if ($password[$i] > 25) {
                $carry = 1;
                $password[$i] = 0;
            }
        }

        return $password;
    }

    public static function rule1(array $password): bool
    {
        for ($i = 0; $i < count($password) - 3; $i++) {
            $first = $password[$i];
            $second = $password[$i + 1];
            $third = $password[$i + 2];

            if ($first + 1 === $second && $second + 1 === $third) {
                return true;
            }
        }
        return false;
    }

    public static function rule2(array $password): bool
    {
        foreach ($password as $char) {
            if ($char === 8 || $char === 11 || $char === 14) {
                return false;
            }
        }
        return true;
    }

    public static function rule3(array $password, bool $findNext = true): bool
    {
        for ($i = 1; $i < count($password); $i++) {
            $first = $password[$i - 1];
            $second = $password[$i];

            $copy = array_slice($password, $i + 1);

            if ($first === $second && !$findNext) {
                return true;
            }

            if ($first === $second && $findNext) {
                return self::rule3($copy, false);
            }
        }
        return false;
    }

    public function part1(string $input): string
    {
        $encoded = self::encodePassword($input);

        for ($i = 0; $i < pow(26, 8); $i++) {
            $encoded = self::nextPassword($encoded);

            if (self::rule1($encoded) && self::rule2($encoded) && self::rule3($encoded)) {
                return self::decodePassword($encoded);
            }
        }

        return 'error';
    }

    public function part2(string $input): string
    {
        return $this->part1($this->part1($input));
    }
}