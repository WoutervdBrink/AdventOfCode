<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day11;

class Monkey
{
    private int $inspectedItems = 0;

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
    )
    {
    }

    public function catch(int $item)
    {
        $this->items[] = $item;
    }

    public function calculateAndThrow(): array
    {
        $thrownItems = [];

        foreach ($this->items as $item) {
            $this->inspectedItems++;

            $item = $this->operation->operate($item);

            $item = floor($item / 3);

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
}