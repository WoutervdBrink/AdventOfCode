<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day07;

use LogicException;

class File implements Node
{
    public function __construct(private readonly string $name, private readonly int $size) {}

    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren(): array
    {
        return [];
    }

    public function addChild(Node $child): void
    {
        throw new LogicException('Files cannot have children');
    }

    public function getName(): string
    {
        return $this->name;
    }
}
