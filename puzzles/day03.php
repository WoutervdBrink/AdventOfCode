<?php

class Map {
    private $map;
    private $size;

    public function __construct(string $input)
    {
        $lines = explode("\n", $input);

        $this->map = [];
        $this->size = 0;

        foreach ($lines as $line) {
            $line = trim($line);

            if (strlen($line) === 0) continue;

            $mapLine = [];

            for ($i = 0; $i < strlen($line); $i++) {
                $mapLine[] = substr($line, $i, 1);
            }

            $this->map[] = $mapLine;
            $this->size = max($this->size, strlen($line));
        }
    }

    public function getHeight()
    {
        return count($this->map);
    }

    public function get(int $x, int $y): string
    {
        return $this->map[$y][$x % $this->size] ?? ' ';
    }

    public function traverse(int $dx, int $dy): int
    {
        $x = 0;
        $y = 0;
        $trees = 0;

        do {
            if ($this->get($x, $y) === '#') {
                $trees++;
            }
            $x += $dx;
            $y += $dy;
        } while ($y < $this->getHeight());

        return $trees;
    }
}

function part1(string $input) {
    $map = new Map($input);

    return $map->traverse(3, 1);
}

function part2(string $input) {
    $map = new Map($input);

    return (
        $map->traverse(1, 1) *
        $map->traverse(3, 1) *
        $map->traverse(5, 1) *
        $map->traverse(7, 1) *
        $map->traverse(1, 2)
    );
}