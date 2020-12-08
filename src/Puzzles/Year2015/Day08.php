<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day08 implements PuzzleSolver
{

    public static function getStringLength(string $string): int
    {
        $string = preg_replace('/\\\\(x[a-f0-9]{2}|\\\\|")/', '_', substr($string, 1, -1));

        return strlen($string);
    }

    #[Pure] public static function getEncodedLength(string $string): int
    {
        $string = preg_replace('/\\\\x[a-f0-9]{2}/', '__x49', $string);
        $string = str_replace('"', '_"', $string);
        $string = str_replace('\\', '__', $string);

        $string = '"'.$string.'"';

        return strlen($string);
    }

    public function part1(string $input): int
    {
        return collect(InputManipulator::splitLines($input))
            ->map(fn (string $string): int => strlen($string) - self::getStringLength($string))
            ->sum();
    }

    public function part2(string $input): int
    {
        return collect(InputManipulator::splitLines($input))
            ->map(fn (string $string): int => self::getEncodedLength($string) - strlen($string))
            ->sum();
    }
}