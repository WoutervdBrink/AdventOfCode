<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day15 implements PuzzleSolver
{
    private array $say;
    private array $history;

    private function say(int $turn, int $num): void
    {
        $this->say[$turn] = $num;

        if (!isset($this->history[$num])) {
            $this->history[$num] = [];
        }

        $this->history[$num][] = $turn;

        if (count($this->history[$num]) === 3) {
            array_shift($this->history[$num]);
        }
    }

    private function lastSaidBefore(int $turn): bool
    {
        if (!isset($this->say[$turn - 1])) {
            return false;
        }

        $last = $this->say[$turn - 1];

        return count($this->history[$last] ?? []) > 1;
    }

    private function getLastTwoTurns(int $turn): array
    {
        $last = $this->say[$turn - 1];

        $history = $this->history[$last];

        return [$history[count($history) - 2], $history[count($history) - 1]];
    }

    private function calculate(string $input, int $n): int
    {
        $input = explode(',', trim($input));
        $input = array_map(fn (string $num): int => intval($num), $input);

        $this->say = [];
        $this->history = [];

        foreach ($input as $turn => $num) {
            $this->say($turn, $num);
        }

        for ($turn = count($input); $turn < $n; $turn++) {
            if ($this->lastSaidBefore($turn)) {
                list($turnBefore, $turnThereBefore) = $this->getLastTwoTurns($turn);

                $this->say($turn, $turnThereBefore - $turnBefore);
            } else {
                $this->say($turn, 0);
            }
        }

        if (isset($this->say[$n - 1])) {
            return $this->say[$n - 1];
        }
        return 0;
    }

    public function part1(string $input): int
    {
        return $this->calculate($input, 2020);
    }

    public function part2(string $input): int
    {
        return $this->calculate($input, 30000000);
    }
}