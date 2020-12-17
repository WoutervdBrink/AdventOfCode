<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use SplFixedArray;

class GameOfLife4D
{
    private int $minX;
    private int $maxX;
    private int $minY;
    private int $maxY;
    private int $minZ;
    private int $maxZ;
    private int $minW;
    private int $maxW;

    private array $cubes;
    private SplFixedArray $deltas;

    public function __construct()
    {
        $this->cubes = [];

        $this->minX = 0;
        $this->maxX = 0;
        $this->minY = 0;
        $this->maxY = 0;
        $this->minZ = 0;
        $this->maxZ = 0;
        $this->minW = 0;
        $this->maxW = 0;

        $this->deltas = new SplFixedArray(80);

        $i = 0;

        for ($dx = -1; $dx <= 1; $dx++) {
            for ($dy = -1; $dy <= 1; $dy++) {
                for ($dz = -1; $dz <= 1; $dz++) {
                    for ($dw = -1; $dw <= 1; $dw++) {
                        if ($dx === 0 && $dy === 0 && $dz === 0 && $dw === 0) {
                            continue;
                        }

                        $this->deltas[$i++] = [$dx, $dy, $dz, $dw];
                    }
                }
            }
        }
    }

    public function getActiveCubes(): int
    {
        $active = 0;

        for ($x = $this->minX; $x <= $this->maxX; $x++) {
            for ($y = $this->minY; $y <= $this->maxY; $y++) {
                for ($z = $this->minZ; $z <= $this->maxZ; $z++) {
                    for ($w = $this->minW; $w <= $this->maxW; $w++) {
                        if ($this->getCube($x, $y, $z, $w)) {
                            $active++;
                        }
                    }
                }
            }
        }

        return $active;
    }

    private function getCube(int $x, int $y, int $z, int $w): bool
    {
        return $this->cubes[$x][$y][$z][$w] ?? false;
    }

    public function evolve(): GameOfLife4D
    {
        $new = new GameOfLife4D();

        for ($x = $this->minX - 1; $x <= $this->maxX + 1; $x++) {
            for ($y = $this->minY - 1; $y <= $this->maxY + 1; $y++) {
                for ($z = $this->minZ - 1; $z <= $this->maxZ + 1; $z++) {
                    for ($w = $this->minW - 1; $w <= $this->maxW + 1; $w++) {
                        $active = $this->getCube($x, $y, $z, $w);
                        $neighbors = $this->getActiveNeighbors($x, $y, $z, $w);

                        if ($active) {
                            // If a cube is *active* and *exactly 2 or 3* of its neighbors are also active, the cube remains
                            // *active*. Otherwise, the cube becomes *inactive*.

                            $new->setCube($x, $y, $z, $w, $neighbors === 2 || $neighbors === 3);
                        } else {
                            // If a cube is *inactive* but *exactly 3* of its neighbors are active, the cube becomes
                            // *active*. Otherwise, the cube remains *inactive*.

                            $new->setCube($x, $y, $z, $w, $neighbors === 3);
                        }
                    }
                }
            }
        }

        return $new;
    }

    public function getActiveNeighbors(int $x, int $y, int $z, int $w): int
    {
        $active = 0;

        foreach ($this->deltas as $delta) {
            list($dx, $dy, $dz, $dw) = $delta;

            if ($this->getCube($x + $dx, $y + $dy, $z + $dz, $w + $dw)) {
                $active++;
            }
        }

        return $active;
    }

    public function setCube(int $x, int $y, int $z, int $w, bool $active): void
    {
        if (!isset($this->cubes[$x])) {
            $this->cubes[$x] = [];
        }

        if (!isset($this->cubes[$x][$y])) {
            $this->cubes[$x][$y] = [];
        }

        if (!isset($this->cubes[$x][$y][$z])) {
            $this->cubes[$x][$y][$z] = [];
        }

        $this->cubes[$x][$y][$z][$w] = $active;

        $this->minX = min($this->minX, $x);
        $this->maxX = max($this->maxX, $x);
        $this->minY = min($this->minY, $y);
        $this->maxY = max($this->maxY, $y);
        $this->minZ = min($this->minZ, $z);
        $this->maxZ = max($this->maxZ, $z);
        $this->minW = min($this->minW, $w);
        $this->maxW = max($this->maxW, $w);
    }
}