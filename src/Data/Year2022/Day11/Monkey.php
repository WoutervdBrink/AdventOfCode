<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11;

use Stringable;

class Monkey implements Stringable
{
    private int $inspectedItems = 0;
    private bool $reducesWorry = false;
    private int $grandModulus = 0;

    /**
     * @param int $modulus
     * @param Operation $operation
     * @param array<int> $items
     */
    public function __construct(
        private readonly int $modulus,
        private readonly Operation $operation,
        private readonly int $trueMonkey,
        private readonly int $falseMonkey,
        private array $items = [],
    ) {
    }

    public function setGrandModulus(int $grandModulus): void
    {
        $this->grandModulus = $grandModulus;
    }

    public function setReducesWorry(bool $reducesWorry): void
    {
        $this->reducesWorry = $reducesWorry;
    }

    public function getModulus(): int
    {
        return $this->modulus;
    }

    public function catch(int $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return array<object>
     */
    public function calculateAndThrow(): array
    {
        assert($this->grandModulus > 0);

        $thrownItems = [];

        foreach ($this->items as $item) {
            $this->inspectedItems++;

            $item = $this->operation->operate($item);

            if ($this->reducesWorry) {
                $item = floor($item / 3);
            }

            $item = $item % $this->grandModulus;

            $thrownItems[] = (object)[
                'monkey' => $item % $this->modulus === 0
                    ? $this->trueMonkey
                    : $this->falseMonkey,
                'item' => $item
            ];
        }

        $this->items = [];

        return $thrownItems;
    }

    public function getInspectedItems(): int
    {
        return $this->inspectedItems;
    }

    public function __toString()
    {
        $str = 'Monkey' . PHP_EOL;
        $str .= '  Items: ' . implode(', ', $this->items) . PHP_EOL;
        $str .= '  Operation: ' . $this->operation . PHP_EOL;
        $str .= '  Test: divisible by ' . $this->modulus . PHP_EOL;
        $str .= '    If true: throw to monkey ' . $this->trueMonkey . PHP_EOL;
        $str .= '    If false: throw to monkey ' . $this->falseMonkey . PHP_EOL;

        return $str;
    }
}