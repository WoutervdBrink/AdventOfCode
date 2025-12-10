<?php

namespace Knevelina\AdventOfCode\Data\Structures;

class UnionFind
{
    /** @var array<int, int> */
    private array $parent;

    public function __construct(int $size)
    {
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i;
        }
    }

    public function find(int $i): int
    {
        if ($this->parent[$i] === $i) {
            return $i;
        }

        return $this->find($this->parent[$i]);
    }

    public function unite(int $i, int $j): void
    {
        $iRep = $this->find($i);
        $jRep = $this->find($j);

        $this->parent[$iRep] = $jRep;
    }
}
