<?php

namespace Knevelina\AdventOfCode\Data\Structures;

class Stack
{
    private array $values = [];

    public function push(mixed $value): void
    {
        $this->values[] = $value;
    }

    public function getLength(): int
    {
        return count($this->values);
    }

    public function pop(): mixed
    {
        return array_pop($this->values);
    }

    public function peek(): mixed
    {
        return ($length = $this->getLength())
            ? $this->values[$length - 1]
            : throw new \OutOfBoundsException('Stack is empty');
    }
}