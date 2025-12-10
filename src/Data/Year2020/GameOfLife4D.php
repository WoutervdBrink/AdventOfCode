<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use SplFixedArray;

class GameOfLife4D
{
    private array $cubes;

    private SplFixedArray $deltas;

    private int $activeCubes;

    public function __construct()
    {
        $this->cubes = [];

        $this->activeCubes = 0;

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

    public function evolve(): GameOfLife4D
    {
        $new = new GameOfLife4D;

        $minX = $maxX = $minY = $maxY = $minZ = $maxZ = $minW = $maxW = 0;

        foreach ($this->cubes as $x => $xCubes) {
            foreach ($xCubes as $y => $yCubes) {
                foreach ($yCubes as $z => $zCubes) {
                    foreach ($zCubes as $w => $wCube) {
                        $minX = min($minX, $x);
                        $maxX = max($maxX, $x);
                        $minY = min($minY, $y);
                        $maxY = max($maxY, $y);
                        $minZ = min($minZ, $z);
                        $maxZ = max($maxZ, $z);
                        $minW = min($minW, $w);
                        $maxW = max($maxW, $w);
                    }
                }
            }
        }

        for ($x = $minX - 1; $x <= $maxX + 1; $x++) {
            for ($y = $minY - 1; $y <= $maxY + 1; $y++) {
                for ($z = $minZ - 1; $z <= $maxZ + 1; $z++) {
                    for ($w = $minW - 1; $w <= $maxW + 1; $w++) {
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

    private function getCube(int $x, int $y, int $z, int $w): bool
    {
        return $this->cubes[$x][$y][$z][$w] ?? false;
    }

    public function getActiveNeighbors(int $x, int $y, int $z, int $w): int
    {
        $active = 0;

        foreach ($this->deltas as $delta) {
            [$dx, $dy, $dz, $dw] = $delta;

            if ($this->getCube($x + $dx, $y + $dy, $z + $dz, $w + $dw)) {
                $active++;
            }
        }

        return $active;
    }

    public function setCube(int $x, int $y, int $z, int $w, bool $active): void
    {
        if (! isset($this->cubes[$x])) {
            $this->cubes[$x] = [];
        }

        if (! isset($this->cubes[$x][$y])) {
            $this->cubes[$x][$y] = [];
        }

        if (! isset($this->cubes[$x][$y][$z])) {
            $this->cubes[$x][$y][$z] = [];
        }

        $this->cubes[$x][$y][$z][$w] = $active;

        if ($active) {
            $this->activeCubes++;
        }
    }

    public function getActiveCubes(): int
    {
        return $this->activeCubes;
    }
}
