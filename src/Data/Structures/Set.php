<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use Generator;

class Set
{
    private array $values;

    public function __construct(mixed ...$values)
    {
        sort($values);
        $this->values = array_values(array_unique($values));
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

    public function getValues(): array
    {
        return $this->values;
    }

    public function calculateUnion(Set $b): Set
    {
        return new Set(array_unique(array_merge($this->getValues(), $b->getValues())));
    }

    public function difference(Set $b): Set
    {
        $bValues = $b->getValues();

        return new Set(array_filter($this->getValues(), fn ($value): bool => ! in_array($value, $bValues)));
    }

    private static function permute(array $elements = []): Generator
    {
        if (count($elements) <= 1) {
            yield $elements;
        } else {
            foreach (self::permute(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    public function permutations(): Generator
    {
        return self::permute($this->values);
    }
}
