<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11\Operations;

use Knevelina\AdventOfCode\Data\Year2022\Day11\Operation;

class Square extends Operation
{
    public function __construct()
    {
        parent::__construct(0);
    }

    public function operate(int $item): int
    {
        return $item * $item;
    }

    public function __toString(): string
    {
        return 'old * old';
    }
}
