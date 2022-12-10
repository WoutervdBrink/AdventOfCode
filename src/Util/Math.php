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