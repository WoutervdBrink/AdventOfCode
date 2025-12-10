<?php

namespace Knevelina\AdventOfCode;

class InputManipulator
{
    public static function getListOfIntegers(string $input): array
    {
        return self::splitLines($input, "\n", fn (string $line) => intval($line));
    }

    public static function splitLines(
        string $input,
        string $delimiter = "\n",
        ?callable $manipulator = null,
        bool $filterEmpty = true
    ): array {
        if (is_null($manipulator)) {
            $manipulator = fn (string $line): string => trim($line);
        }

        $lines = array_map(fn (string $line) => $manipulator($line), explode($delimiter, $input));

        return $filterEmpty ? $lines :
            array_filter($lines, fn ($line) => strlen($line));
    }
}
