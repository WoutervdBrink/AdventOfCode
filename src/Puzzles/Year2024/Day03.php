<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Util\StringConsumer;

class Day03 extends CombinedPuzzleSolver
{
    /**
     * @param string $input
     * @return list<int>
     */
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $consumer = new StringConsumer($input);
        $factor = 1;
        $part1 = 0;
        $part2 = 0;

        while (!$consumer->done()) {
            if ($consumer->peek(4) === 'mul(') {
                $consumer->consume(4);
            } else if ($consumer->consumeIf('do(')) {
                $factor = 1;
                continue;
            } else if ($consumer->consumeIf('don\'t(')) {
                $factor = 0;
                continue;
            } else {
                $consumer->consume(1);
                continue;
            }

            $num1 = 0;
            $num2 = 0;

            while (is_numeric($char = $consumer->consume(1))) {
                $num1 = 10 * $num1 + intval($char);
            }

            if ($char !== ',') {
                continue;
            }

            while (is_numeric($char = $consumer->consume(1))) {
                $num2 = 10 * $num2 + intval($char);
            }

            if ($char !== ')') {
                continue;
            }

            $part1 += $num1 * $num2;
            $part2 += $num1 * $num2 * $factor;
        }

        return CombinedPuzzleOutput::of($part1, $part2);
    }
}