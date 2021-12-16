<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

class Cave
{
    private array $connections;
    private bool $isBig;

    public function __construct(private string $name)
    {
        $this->connections = [];
        $this->isBig = ord($name[0]) < 97;
    }

    public function connect(Cave $other): void
    {
        $this->connections[] = $other;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<Cave>
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    /**
     * @return bool
     */
    public function isBig(): bool
    {
        return $this->isBig;
    }

    /**
     * @return bool
     */
    public function isSmall(): bool
    {
        return !$this->isBig;
    }
}