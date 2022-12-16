<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day13;

enum Result
{
    case VALID;
    case INVALID;
    case INDECISIVE;

    public function isDecisive(): bool
    {
        return $this !== self::INDECISIVE;
    }
}
