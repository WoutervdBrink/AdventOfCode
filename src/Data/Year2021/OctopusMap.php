<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

use Knevelina\AdventOfCode\Data\Structures\Map;

class OctopusMap extends Map
{
    public function iterate(): int
    {
        // First, the energy level of each octopus increases by 1.
        for ($x = 0; $x < $this->getWidth(); $x++) {
            for ($y = 0; $y < $this->getHeight(); $y++) {
                $this->setValue($x, $y, $this->getValue($x, $y) + 1);
            }
        }

        // Then, any octopus with an energy level greater than 9 flashes. This increases the energy level of all
        // adjacent octopuses by 1, including octopuses that are diagonally adjacent. If this causes an octopus to have
        // an energy level greater than 9, it also flashes. This process continues as long as new octopuses keep having
        // their energy level increased beyond 9. (An octopus can only flash at most once per step.)

        $flashes = 0;

        for ($x = 0; $x < $this->getWidth(); $x++) {
            for ($y = 0; $y < $this->getHeight(); $y++) {
                if ($this->getValue($x, $y) === 10) {
                    $flashes += $this->flash($x, $y);
                }
            }
        }

        // Finally, any octopus that flashed during this step has its energy level set to 0, as it used all of its
        // energy to flash.
        for ($x = 0; $x < $this->getWidth(); $x++) {
            for ($y = 0; $y < $this->getHeight(); $y++) {
                if ($this->getValue($x, $y) === -1) {
                    $this->setValue($x, $y, 0);
                }
            }
        }

        return $flashes;
    }

    private function flash(int $fromX, int $fromY): int
    {
        $flashes = 1;

        $this->setValue($fromX, $fromY, -1);

        foreach ([-1, 0, 1] as $dy) {
            foreach ([-1, 0, 1] as $dx) {
                $x = $fromX + $dx;
                $y = $fromY + $dy;

                if (!$this->isWithinBounds($x, $y)) {
                    continue;
                }

                if ($this->getValue($x, $y) === -1) {
                    continue;
                }

                $this->setValue($x, $y, $this->getValue($x, $y) + 1);
                if ($this->getValue($x, $y) >= 10) {
                    $flashes += $this->flash($x, $y);
                }
            }
        }

        return $flashes;
    }
}