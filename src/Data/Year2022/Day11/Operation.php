<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11;

abstract class Operation
{
    public function __construct(protected readonly int $argument)
    {
    }

    public abstract function operate(int $item): int;
}