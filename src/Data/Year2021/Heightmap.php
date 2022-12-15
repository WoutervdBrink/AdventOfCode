<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Structures\Point;

class Heightmap extends Grid
{
    public function getBasin(int $x, int $y): array
    {
        $queue = [new Point($x, $y)];
        $visited = [];
        $basin = [];

        while (count($queue)) {
            $cursor = array_shift($queue);

            if (isset($visited[$cursor->hash()])) {
                continue;
            }

            $value = $this->getValue($cursor->getX(), $cursor->getY());

            $visited[$cursor->hash()] = true;

            if ($value === null || $value === 9) {
                continue;
            }

            $basin[] = $value;

            $neighbors = $cursor->getNeighbors(false);

            foreach ($neighbors as $neighbor) {
                if (!isset($visited[$neighbor->hash()])) {
                    $queue[] = $neighbor;
                }
            }
        }

        return $basin;
    }

    /**
     * @return LowPoint[]
     */
    public function getLowPoints(): array
    {
        $lowPoints = [];

        for ($y = 0; $y < $this->getHeight(); $y++) {
            for ($x = 0; $x < $this->getWidth(); $x++) {
                $neighbors = $this->getNeighborValues($x, $y, false);
                $value = $this->getValue($x, $y);

                if (min($neighbors) > $value) {
                    $lowPoints[] = new LowPoint($x, $y, $value);
                }
            }
        }

        return $lowPoints;
    }
}