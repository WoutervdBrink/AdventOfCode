<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11\Operations;

use Knevelina\AdventOfCode\Data\Year2022\Day11\Operation;

class Multiply extends Operation
{
    public function operate(int $item): int
    {
        return $this->argument * $item;
    }

    public function __toString(): string
    {
        return sprintf('old * %d', $this->argument);
    }
}
