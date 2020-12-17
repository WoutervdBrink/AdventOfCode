<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use ArrayAccess;
use Countable;
use Generator;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Arr implements ArrayAccess, Countable
{
    private array $values;

    public function __construct(mixed ...$values)
    {
        $this->values = array_values($values);
    }

    #[Pure] public static function of(mixed ...$values): Arr
    {
        return new Arr(...$values);
    }

    public static function zip(Arr ...$arrs): Arr
    {
        if (count($arrs) === 0) {
            return Arr::empty();
        }

        $joins = [];
        $length = count($arrs[0]);

        for ($i = 0; $i < $length; $i++) {
            $join = [];

            foreach ($arrs as $j => $arr) {
                if (!$arr->has($i)) {
                    throw new InvalidArgumentException(sprintf('Arr %d has no element %d!', $j, $i));
                }

                $join[] = $arrs[$i];
            }

            $joins[] = $join;
        }

        return Arr::fromArray($joins);
    }

    #[Pure] public static function empty(): Arr
    {
        return new Arr();
    }

    #[Pure] public function has($offset): bool
    {
        return $this->offsetExists($offset);
    }

    #[Pure] public function offsetExists($offset)
    {
        return array_key_exists($this->values, $offset);
    }

    #[Pure] public static function fromArray(array $values): Arr
    {
        return new Arr($values);
    }

    public function offsetGet($offset)
    {
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    public function iteratePairs(): Generator
    {
        for ($i = 0; $i < $this->count(); $i++) {
            for ($j = $i + 1; $j < $this->count(); $j++) {
                yield [$this->get($i), $this->get($j)];
            }
        }
    }

    #[Pure] public function count(): int
    {
        return count($this->values);
    }

    #[Pure] public function get(int $offset): mixed
    {
        return $this->has($offset) ? $this->values[$offset] : null;
    }

    public function iterateTriplets(): Generator
    {
        for ($i = 0; $i < $this->count(); $i++) {
            for ($j = $i + 1; $j < $this->count(); $j++) {
                for ($k = $j + 1; $k < $this->count(); $k++) {
                    yield [$this->get($i), $this->get($j), $this->get($k)];
                }
            }
        }
    }
}