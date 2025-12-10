<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

use JetBrains\PhpStorm\Pure;

class WireOperator
{
    const VALUE = 0;

    const AND = 1;

    const OR = 2;

    const LSHIFT = 3;

    const RSHIFT = 4;

    const NOT = 5;

    #[Pure]
    public static function getOperatorForName(string $name): int
    {
        return match ($name) {
            'AND' => self::AND,
            'OR' => self::OR,
            'LSHIFT' => self::LSHIFT,
            'RSHIFT' => self::RSHIFT,
            'NOT' => self::NOT,
            default => self::VALUE
        };
    }

    #[Pure]
    public static function apply(int $operation, int $operand0, int $operand1 = 0): int
    {
        return match ($operation) {
            self::VALUE => $operand0,
            self::AND => $operand0 & $operand1,
            self::OR => $operand0 | $operand1,
            self::LSHIFT => $operand0 << $operand1,
            self::RSHIFT => $operand0 >> $operand1,
            self::NOT => ~$operand0,
            default => 0
        } & 65535;
    }
}
