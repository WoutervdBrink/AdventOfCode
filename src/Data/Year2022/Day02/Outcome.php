<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day02;

use InvalidArgumentException;

enum Outcome: int
{
    case LOSS = 0;
    case DRAW = 3;
    case WIN = 6;

    public static function fromMoves(Move $ours, Move $theirs): self
    {
        if ($ours === $theirs) {
            return self::DRAW;
        }

        return $ours->getPrey() === $theirs ? self::WIN : self::LOSS;
    }

    public static function fromInput(string $outcome): self
    {
        return match ($outcome) {
            'X' => self::LOSS,
            'Y' => self::DRAW,
            'Z' => self::WIN,
            default => throw new InvalidArgumentException(sprintf('"%s" is not a valid outcome charachter', $outcome))
        };
    }
}
