<?php


namespace Knevelina\AdventOfCode;


class InputManipulator
{
    public static function splitLines(string $input, string $delimiter = "\n", callable $manipulator = null, bool $filterEmpty = true)
    {
        if (is_null($manipulator)) {
            $manipulator = fn ($line) => trim($line);
        }

        $lines = array_map(fn ($line) => $manipulator($line), explode($delimiter, $input));

        return $filterEmpty ? $lines :
            array_filter($lines, fn ($line) => strlen($line));
    }

    public static function getListOfIntegers(string $input)
    {
        return self::splitLines($input, "\n", fn ($line) => intval($line));
    }
}