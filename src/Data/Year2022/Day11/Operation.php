<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11;

use Stringable;

abstract class Operation implements Stringable
{
    public function __construct(protected readonly int $argument)
    {
    }

    public abstract function operate(int $item): int;
}