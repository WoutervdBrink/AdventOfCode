<?php

namespace Knevelina\AdventOfCode\Data\Year2022\Day08;

class Tree
{
    private bool $visible = false;
    private int $score = 1;

    public function __construct(private int $value)
    {
    }

    public function pushScore(int $score): void
    {
        $this->score *= $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function show(): void
    {
        $this->visible = true;
    }

    public function hide(): void
    {
        $this->visible = false;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}