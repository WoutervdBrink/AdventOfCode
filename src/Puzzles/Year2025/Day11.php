<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Ds\Map;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Graph\Graph;
use Knevelina\AdventOfCode\Data\Structures\Graph\Vertex;
use Override;

class Day11 implements PuzzleSolver
{
    /**
     * @return Graph<string>
     */
    private static function parse(string $input): Graph
    {
        /** @var Graph<string> $graph */
        $graph = new Graph;

        foreach (explode("\n", $input) as $line) {
            [$source, $destinations] = explode(': ', $line, 2);

            $srcVertex = self::getVertex($graph, $source);

            foreach (explode(' ', $destinations) as $destination) {
                $dstVertex = self::getVertex($graph, $destination);
                $srcVertex->addEdgeTo($dstVertex);
            }
        }

        return $graph;
    }

    /**
     * Get or create (if it does not exist yet) the vertex with the given ID.
     *
     * @param  Graph<string>  $graph
     * @return Vertex<string>
     */
    private static function getVertex(Graph $graph, string $id): Vertex
    {
        /** @var Map<Graph<string>, Map<string, Vertex<string>>> $vertexMap */
        static $vertexMap = new Map;

        if (! $vertexMap->hasKey($graph)) {
            $vertexMap->put($graph, new Map);
        }

        $map = $vertexMap->get($graph);

        if (! $map->hasKey($id)) {
            $vertex = $graph->createVertex($id, $id);
            $map->put($id, $vertex);
        }

        return $map->get($id);
    }

    #[Override]
    public function part1(string $input): int
    {
        $graph = self::parse($input);

        return $graph->countPaths(self::getVertex($graph, 'you'), self::getVertex($graph, 'out'));
    }

    #[Override]
    public function part2(string $input): int
    {
        $graph = self::parse($input);

        $svr = self::getVertex($graph, 'svr');
        $out = self::getVertex($graph, 'out');
        $dac = self::getVertex($graph, 'dac');
        $fft = self::getVertex($graph, 'fft');

        return $graph->countPaths($svr, $dac) * $graph->countPaths($dac, $fft) * $graph->countPaths($fft, $out)
            + $graph->countPaths($svr, $fft) * $graph->countPaths($fft, $dac) * $graph->countPaths($dac, $out);
    }
}
