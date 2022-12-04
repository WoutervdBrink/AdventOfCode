<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day02;

use InvalidArgumentException;

enum Move: int
{
    case ROCK = 1;
    case PAPER = 2;
    case SCISSORS = 3;

    public static function fromInput(string $move): self
    {
        return match ($move) {
            'A', 'X' => self::ROCK,
            'B', 'Y' => self::PAPER,
            'C', 'Z' => self::SCISSORS,
            default => throw new InvalidArgumentException(sprintf('"%s" is not a valid move charachter', $move))
        };
    }

    /**
     * Get the move's 'natural prey' - the move that is beatable by this move.
     * @return Move
     */
    public function getPrey(): Move
    {
        return match($this) {
            self::ROCK => self::SCISSORS,
            self::PAPER => self::ROCK,
            self::SCISSORS => self::PAPER,
        };
    }

    /**
     * Get the move's 'natural predator' - the move that beats this move.
     * @return Move
     */
    public function getPredator(): Move
    {
        return match($this) {
            self::ROCK => self::PAPER,
            self::PAPER => self::SCISSORS,
            self::SCISSORS => self::ROCK,
        };
    }
}
