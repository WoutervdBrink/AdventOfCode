<?php

namespace Knevelina\AdventOfCode\Contracts;

interface PuzzleVisualizer
{
    public function visualize(string $input, string $path): void;
}
