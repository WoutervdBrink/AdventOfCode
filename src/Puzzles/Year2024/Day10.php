<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Ds\Map;
use Ds\Set;
use Ds\Stack;
use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Graph\Graph;
use Knevelina\AdventOfCode\Data\Structures\Graph\GraphIO;
use Knevelina\AdventOfCode\Data\Structures\Graph\Vertex;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Structures\Point;
use Override;

class Day10 extends CombinedPuzzleSolver
{
    #[Override]
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $zeroVertices = self::parse($input);

        $part1 = self::search($zeroVertices, false);
        $part2 = self::search($zeroVertices, true);

        return CombinedPuzzleOutput::of($part1, $part2);
    }

    public function parse(string $input): Set
    {
        $grid = Grid::fromInput($input);

        /** @var Map<Point, Vertex> $verticeMap */
        $verticeMap = new Map;

        /** @var Set<Vertex> $zeroVertices */
        $zeroVertices = new Set;

        $graph = new Graph;

        foreach ($grid->getEntries() as $entry) {
            $x = $entry->getX();
            $y = $entry->getY();
            $value = $entry->getValue();
            $point = new Point($x, $y);
            $vertex = self::getOrAddVertex($graph, $verticeMap, $point, $value);

            if ($value === 0) {
                $zeroVertices->add($vertex);
            }

            foreach ($grid->getNeighbors($x, $y, false) as $neighbor) {
                $neighborPoint = new Point($neighbor->getX(), $neighbor->getY());
                $neighborVertex = self::getOrAddVertex($graph, $verticeMap, $neighborPoint, $neighbor->getValue());
                if ($neighborVertex->value === ($value + 1)) {
                    $vertex->addEdgeTo($neighborVertex);
                }
            }
        }

        GraphIO::writeDot(__DIR__.'/../../../visuals/2024day10.dot', $graph);

        return $zeroVertices;
    }

    private static function getOrAddVertex(Graph $graph, Map $verticeMap, Point $point, int $value): Vertex
    {
        if (! $verticeMap->hasKey($point)) {
            $vertex = $graph->createVertex($point->getX().'_'.$point->getY(), $value);
            $verticeMap->put($point, $vertex);
        }

        return $verticeMap->get($point);
    }

    private static function search(Set $zeroVertices, bool $countDistinct): int
    {
        $result = 0;

        foreach ($zeroVertices as $vertex) {
            /** @var Stack<Vertex> $queue */
            $queue = new Stack;
            /** @var Set<Vertex> $discovered */
            $discovered = new Set;
            $queue->push($vertex);

            while (! $queue->isEmpty()) {
                $vertex = $queue->pop();

                if ($countDistinct || ! $discovered->contains($vertex)) {
                    if (! $countDistinct) {
                        $discovered->add($vertex);
                    }

                    if ($vertex->value === 9) {
                        $result++;
                    }

                    foreach ($vertex->getNeighbors() as $neighbor) {
                        $queue->push($neighbor);
                    }
                }
            }
        }

        return $result;
    }
}
