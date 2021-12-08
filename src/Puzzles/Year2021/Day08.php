<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use RuntimeException;

class Day08 implements PuzzleSolver
{
    const HASH_TO_DIGIT = [
        74 => 0,
        58 => 1,
        73 => 3,
        76 => 4,
        54 => 6,
        63 => 7,
        83 => 8,
        82 => 9
    ];

    public static function processLine(string $line): array
    {
        $line = explode(' | ', $line, 2);

        if (count($line) !== 2) {
            throw new InvalidArgumentException(sprintf('Invalid 7-segement input line "%s"', $line));
        }

        list($signals, $values) = $line;

        $signals = explode(' ', $signals);
        $values = explode(' ', $values);

        return [$signals, $values];
    }

    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: [self::class, 'processLine']);

        $total = 0;

        foreach ($input as $line) {
            foreach ($line[1] as $value) {
                if (in_array(strlen($value), [2, 4, 3, 7])) {
                    $total++;
                }
            }
        }

        return $total;
    }

    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: [self::class, 'processLine']);

        $total = 0;

        foreach ($input as $line) {
            list($signals, $values) = $line;

            $digitToSignal = [];

            $signals5 = [];
            $signals6 = [];

            foreach ($signals as $signal) {
                if (strlen($signal) === 2) {
                    $digitToSignal[1] = $signal;
                }
                if (strlen($signal) === 4) {
                    $digitToSignal[4] = $signal;
                }
                if (strlen($signal) === 3) {
                    $digitToSignal[7] = $signal;
                }
                if (strlen($signal) === 7) {
                    $digitToSignal[8] = $signal;
                }
                if (strlen($signal) === 5) {
                    $signals5[] = $signal;
                }
                if (strlen($signal) === 6) {
                    $signals6[] = $signal;
                }
            }

            $found = 0;
            foreach ($signals6 as $signal) {
                if (self::segmentsInCommon($signal, $digitToSignal[1]) === 2) {
                    if (self::segmentsInCommon($signal, $digitToSignal[4]) === 4) {
                        $digitToSignal[9] = $signal;
                        $found++;
                    } else {
                        $digitToSignal[0] = $signal;
                        $found++;
                    }
                } else {
                    $digitToSignal[6] = $signal;
                    $found++;
                }
            }

            if ($found !== 3) {
                throw new RuntimeException('Found %d 6-segment signals, but intended to find 3!', $found);
            }

            $found = 0;
            foreach ($signals5 as $signal) {
                if (self::segmentsInCommon($signal, $digitToSignal[1]) === 2) {
                    $digitToSignal[3] = $signal;
                    $found++;
                } else {
                    if (self::segmentsInCommon($signal, $digitToSignal[9]) === 5) {
                        $digitToSignal[5] = $signal;
                        $found++;
                    } else {
                        $digitToSignal[2] = $signal;
                        $found++;
                    }
                }
            }

            if ($found !== 3) {
                throw new RuntimeException('Found %d 5-segment signals, but intended to find 3!', $found);
            }

            $signalToDigit = [];
            foreach ($digitToSignal as $digit => $signal) {
                $signal = str_split($signal);
                sort($signal);
                $signal = join('', $signal);
                $signalToDigit[$signal] = $digit;
            }

            $vs = [];

            foreach ($values as $value) {
                $signal = str_split($value);
                sort($signal);
                $signal = join('', $signal);
                if (!isset($signalToDigit[$signal])) {
                    throw new RuntimeException(
                        sprintf('Could not decode signal "%s" ("%s") as a digit!', $value, $signal)
                    );
                }

                $vs[] = $signalToDigit[$signal];
            }

            $v = $vs[0] * 1000 + $vs[1] * 100 + $vs[2] * 10 + $vs[3];

            $total += $v;
        }

        return $total;
    }

    protected static function segmentsInCommon(string $signal1, string $signal2): int
    {
        $common = 0;

        foreach (range('a', 'g') as $letter) {
            if (str_contains($signal1, $letter) && str_contains($signal2, $letter)) {
                $common++;
            }
        }

        return $common;
    }
}