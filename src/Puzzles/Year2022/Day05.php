<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day05 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): string
    {
        return self::solve($input, function (array &$from, array &$to, int $amount): void {
            for ($i = 0; $i < $amount; $i++) {
                $item = array_shift($from);

                if ($item) {
                    array_unshift($to, $item);
                }
            }
        });
    }

    private static function solve(string $input, callable $mover): string
    {
        [$moves, $stacks] = self::parseInput($input);

        foreach ($moves as $move) {
            $from = &$stacks[$move->from - 1];
            $to = &$stacks[$move->to - 1];

            $mover($from, $to, $move->amount);
        }

        return self::getAnswerForStacks($stacks);
    }

    private static function parseInput(string $input): array
    {
        [$inputStacks, $inputMoves] = explode("\n\n", $input, 2);

        $inputStacks = explode("\n", $inputStacks);
        array_pop($inputStacks); // Ignore 1, 2, 3, et cetera

        $stacks = array_fill(
            0,
            $numStacks = ceil(
                array_reduce($inputStacks, fn (int $max, string $line): int => max($max, strlen($line)), 0) / 4
            ),
            []
        );

        foreach ($inputStacks as $line) {
            for ($i = 0; $i < $numStacks; $i++) {
                $item = trim(substr($line, $i * 4 + 1, 1));
                if ($item !== '') {
                    $stacks[$i][] = $item;
                }
            }
        }

        $moves = InputManipulator::splitLines($inputMoves, manipulator: function (string $inputMove): object {
            if (! preg_match('/^move (\d+) from (\d+) to (\d+)$/', $inputMove, $matches)) {
                throw new RuntimeException(sprintf('Invalid move description "%s"', $inputMove));
            }

            return (object) [
                'amount' => $matches[1],
                'from' => $matches[2],
                'to' => $matches[3],
            ];
        });

        return [$moves, $stacks];
    }

    private static function getAnswerForStacks(mixed $stacks): string
    {
        return implode('', array_map(fn (array $stack): string => array_shift($stack), $stacks));
    }

    #[Override]
    public function part2(string $input): string
    {
        return self::solve($input, function (array &$from, array &$to, int $amount): void {
            $items = array_splice($from, 0, $amount);

            if ($items) {
                array_unshift($to, ...$items);
            }
        });
    }
}
