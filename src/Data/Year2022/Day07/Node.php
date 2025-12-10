<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day07;

interface Node
{
    public function getSize(): int;

    public function getName(): string;

    /**
     * @return array<Node>
     */
    public function getChildren(): array;

    public function addChild(Node $child): void;
}
