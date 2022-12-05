<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day05 implements PuzzleSolver
{
    public function part1(string $input): string
    {
        $password = '';

        for ($i = 0; ; $i++) {
            $hash = hash('md5', $input . $i);

            for ($j = 0; $j < 5; $j++) {
                if ($hash[$j] !== '0') {
                    break;
                }
            }

            if ($j === 5) {
                $password .= $hash[5];

                if (strlen($password) === 8) {
                    return $password;
                }
            }
        }
    }

    public function part2(string $input): string
    {
        $password = str_repeat('_', 8);
        $completed = 0;

        for ($i = 0; ; $i++) {
            $hash = hash('md5', $input . $i);

            for ($j = 0; $j < 5; $j++) {
                if ($hash[$j] !== '0') {
                    break;
                }
            }

            if ($j === 5) {
                if ($hash[5] >= 'a' && $hash[5] <= 'f') {
                    continue;
                }

                $index = intval($hash[5]);

                if ($index > 7) {
                    continue;
                }

                if ($password[$index] === '_') {
                    $password[$index] = $hash[6];
                    $completed++;
                }

                if ($completed === 8) {
                    return $password;
                }
            }
        }
    }
}