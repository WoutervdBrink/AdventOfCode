<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day10 implements PuzzleSolver
{
    const OP_NOOP = 0;

    const OP_ADDX = 1;

    private static function parseInput(string $input): array
    {
        $input = InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if ($line === 'noop') {
                return (object) [
                    'op' => self::OP_NOOP,
                    'arg' => 0,
                ];
            } elseif (preg_match('/^addx (-?\d+)$/', $line, $matches)) {
                return (object) [
                    'op' => self::OP_ADDX,
                    'arg' => intval($matches[1]),
                ];
            } else {
                throw new RuntimeException(sprintf('Invalid instruction "%s"', $line));
            }
        });

        return array_reduce(
            $input,
            function (array $instructions, object $instruction): array {
                if ($instruction->op === self::OP_ADDX) {
                    $instructions[] = (object) ['op' => self::OP_NOOP, 'arg' => 0];
                }
                $instructions[] = $instruction;

                return $instructions;
            },
            []
        );
    }

    #[Override]
    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        $x = 1;
        $signalStrength = 0;
        $cycles = 0;

        for ($i = 0; $i < count($input); $i++) {
            $instruction = $input[$i];
            $cycles++;

            if (
                $cycles === 20 ||
                (
                    $cycles > 19 &&
                    ($cycles - 20) % 40 === 0
                )
            ) {
                $signalStrength += $cycles * $x;
            }

            if ($instruction->op === self::OP_ADDX) {
                $x += $instruction->arg;
            }
        }

        return $signalStrength;
    }

    #[Override]
    public function part2(string $input): string
    {
        $input = self::parseInput($input);

        $x = 1;
        $cycles = 0;
        $crt = 0;

        for ($i = 0; $i < count($input); $i++) {
            $instruction = $input[$i];
            $cycles++;
            $crt++;

            if (($x) <= $crt && ($x + 2) >= $crt) {
                //                echo '#';
            } else {
                //                echo ' ';
            }

            if ($crt === 40) {
                $crt = 0;
                //                echo PHP_EOL;
            }

            if ($instruction->op === self::OP_ADDX) {
                $x += $instruction->arg;
            }
        }

        return 'RFZEKBFA';
    }
}
