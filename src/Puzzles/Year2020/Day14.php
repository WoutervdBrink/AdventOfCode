<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day14 implements PuzzleSolver
{
    const MASK = 0;
    const MEM = 1;

    public function part1(string $input): int
    {
        $mem = [];
        $mask = '';

        foreach (self::parse($input) as $instruction) {
            switch ($instruction[0]) {
                case self::MASK:
                    $mask = $instruction[1];
                    break;
                case self::MEM:
                    $mem[$instruction[1]] = self::applyMask($mask, $instruction[2]);
                    break;
            }
        }

        return array_sum($mem);
    }

    /**
     * @param string $input
     * @return array
     */
    private static function parse(string $input): array
    {
        $input = InputManipulator::splitLines($input);

        return array_map(
            function (string $line): array {
                if (preg_match('/^mask = ([X01]{36})$/', $line, $matches)) {
                    return [self::MASK, $matches[1]];
                }

                if (preg_match('/^mem\\[(\d+)] = (\d+)$/', $line, $matches)) {
                    return [self::MEM, intval($matches[1]), intval($matches[2])];
                }

                throw new InvalidArgumentException(sprintf("Invalid instruction '%s'", $line));
            },
            $input
        );
    }

    #[Pure] protected static function applyMask(string $mask, int $value): int
    {
        $masked = 0;
        $bits = self::intToBits($value);

        for ($i = 0; $i < 36; $i++) {
            $maskBit = substr($mask, $i, 1);
            $valueBit = substr($bits, $i, 1);

            if ($maskBit === 'X') {
                $masked = $masked * 2 + intval($valueBit);
            } else {
                $masked = $masked * 2 + intval($maskBit);
            }
        }

        return $masked;
    }

    private static function intToBits(int $value): string
    {
        $bits = decbin($value);

        return str_repeat('0', 36 - strlen($bits)) . $bits;
    }

    public function part2(string $input): int
    {
        $mem = [];
        $mask = '';

        foreach (self::parse($input) as $instruction) {
            switch ($instruction[0]) {
                case self::MASK:
                    $mask = $instruction[1];
                    break;
                case self::MEM:
                    foreach (self::getAddresses($mask, $instruction[1]) as $address) {
                        $mem[$address] = $instruction[2];
                    }
                    break;
            }
        }

        return (int)array_sum($mem);
    }

    #[Pure] private static function getAddresses(string $mask, int $address): array
    {
        $addresses = [''];

        $bits = self::intToBits($address);

        for ($i = 0; $i < 36; $i++) {
            $maskBit = substr($mask, $i, 1);
            $addressBit = substr($bits, $i, 1);

            switch ($maskBit) {
                case 'X':
                    $new = [];
                    foreach ($addresses as $key => $address) {
                        $new[] = $address . '1';
                        $addresses[$key] .= '0';
                    }
                    $addresses = array_merge($addresses, $new);
                    break;
                case '0':
                    foreach ($addresses as $key => $address) {
                        $addresses[$key] .= $addressBit;
                    }
                    break;
                case '1':
                    foreach ($addresses as $key => $address) {
                        $addresses[$key] .= '1';
                    }
                    break;
            }
        }

        return $addresses;
    }
}