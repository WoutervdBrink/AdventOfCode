<?php

namespace Knevelina\AdventOfCode\Util\Math;

function sign(int|float $x): int
{
    return match (true) {
        $x < 0 => -1,
        $x > 0 => 1,
        default => 0
    };
}

function gcd(int $a, int $b): int
{
    if ($a % $b) {
        return gcd($b, $a % $b);
    }

    return $b;
}

function lcm(int $a, int $b): int
{
    $large = max($a, $b);
    $small = min($a, $b);

    $i = $large;

    while (true) {
        if ($i % $small === 0) {
            return $i;
        }

        $i = $i + $large;
    }
}
