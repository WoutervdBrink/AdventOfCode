<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day07;

class Directory implements Node
{
    /**
     * @var array<Node>
     */
    private array $children;

    public function __construct(private readonly string $name)
    {
    }

    public function getSize(): int
    {
        return array_sum(array_map(fn(Node $node): int => $node->getSize(), $this->children));
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(Node $child): void
    {
        $this->children[] = $child;
    }
}