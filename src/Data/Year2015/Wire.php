<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

#[Immutable]
class Wire
{
    public function __construct(private int $operator, private array $operands) {}

    #[Pure]
    public function __toString(): string
    {
        return $this->operator.'('.implode(', ', $this->operands).')';
    }

    public function getOperator(): int
    {
        return $this->operator;
    }

    public function getOperands(): array
    {
        return $this->operands;
    }
}
