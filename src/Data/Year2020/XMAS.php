<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

class XMAS
{
    private int $preambleSize;

    private array $history;

    public function __construct(int $preambleSize)
    {
        $this->preambleSize = $preambleSize;
        $this->history = [];
    }

    public function push(int $number): bool
    {
        if (! $this->isValid($number)) {
            return false;
        }

        $this->history[] = $number;

        if (count($this->history) > $this->preambleSize) {
            array_shift($this->history);
        }

        return true;
    }

    public function isValid(int $number): bool
    {
        if (count($this->history) < $this->preambleSize) {
            return true;
        }

        foreach ($this->history as $x) {
            foreach ($this->history as $y) {
                if ($x !== $y && $x + $y === $number) {
                    return true;
                }
            }
        }

        return false;
    }
}
