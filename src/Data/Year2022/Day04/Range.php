<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day04;

use DomainException;

class Range
{
    public function __construct(private readonly int $first, private readonly int $last)
    {
        if ($this->first > $this->last) {
            throw new DomainException(sprintf('Invalid first and last %d and %d: first is after last', $this->first, $this->last));
        }
    }

    public function getFirst(): int
    {
        return $this->first;
    }

    public function getLast(): int
    {
        return $this->last;
    }

    public function contains(Range $other): bool
    {
        return $other->getFirst() >= $this->first && $other->getLast() <= $this->last;
    }

    public function hasOverlapWith(Range $other): bool
    {
        return $other->getFirst() <= $this->last && $other->getLast() >= $this->first;
    }
}
