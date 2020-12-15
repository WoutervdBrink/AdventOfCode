<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use JetBrains\PhpStorm\Pure;

class Set
{
    private array $values;

    /**
     * @return mixed[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    public function __construct(mixed ...$values)
    {
        $this->values = array_unique($values);
    }

    public static function fromArray(array $values): Set
    {
        return new Set(...$values);
    }

    public static function of(mixed ...$values): Set
    {
        return new Set($values);
    }

    public function calculateIntersect(Set $b): Set
    {
        return new Set(array_intersect($this->getValues(), $b->getValues()));
    }

    public function calculateUnion(Set $b): Set
    {
        return new Set(array_unique(array_merge($this->getValues(), $b->getValues())));
    }

    public function difference(Set $b): Set
    {
        $bValues = $b->getValues();

        return new Set(array_filter($this->getValues(), fn($value): bool => !in_array($value, $bValues)));
    }
}