<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day04;

use InvalidArgumentException;

final class Card
{
    private readonly int $matches;

    private function __construct(array $winning, array $having)
    {
        $matches = 0;

        foreach ($winning as $winningNumber) {
            foreach ($having as $havingNumber) {
                if ($winningNumber === $havingNumber) {
                    $matches++;
                }
            }
        }

        $this->matches = $matches;
    }

    public static function fromInput(string $line): Card
    {
        $parts = explode(' | ', $line, 2);

        if (count($parts) !== 2) {
            throw new InvalidArgumentException(sprintf('Invalid game specification "%s"', $line));
        }

        $parts[0] = preg_replace('/Card +(\d+): /', '', $parts[0]);

        if (!preg_match_all('/(\d+)/', $parts[0], $matches)) {
            throw new InvalidArgumentException(sprintf('Invalid winning number specification "%s"', $line));
        }

        $winning = array_map(fn(string $match): int => intval(trim($match)), $matches[1]);

        if (!preg_match_all('/(\d+)/', $parts[1], $matches)) {
            throw new InvalidArgumentException(sprintf('Invalid having number specification "%s"', $line));
        }

        $having = array_map(fn(string $match): int => intval(trim($match)), $matches[1]);

        return new Card($winning, $having);
    }

    public function getMatches(): int
    {
        return $this->matches;
    }

    public function getScore(): float
    {
        return $this->matches > 0 ? pow(2, $this->matches - 1) : 0;
    }
}