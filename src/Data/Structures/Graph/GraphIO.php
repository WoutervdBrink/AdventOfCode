<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use RuntimeException;

/**
 * Utility class for working with graphs and input/output.
 */
class GraphIO
{
    /**
     * Render a graph as a DOT file.
     *
     * @param string $path Path to store the DOT file. The file will be overwritten if it exists.
     * @param Graph $graph The graph to write.
     * @return void
     */
    public static function writeDot(string $path, Graph $graph): void
    {
        $fp = fopen($path, 'w');

        if ($fp === false) {
            throw new RuntimeException(sprintf('Could not open file "%s" for writing', $path));
        }

        fwrite($fp, 'digraph G {' . PHP_EOL);

        $vertices = $graph->getVertices();

        foreach ($vertices as $i => $v) {
            fwrite($fp, sprintf('  %d [penwidth=3, label="%s\\nValue: %s"]%s', $i, $v->label, $v->value, PHP_EOL));
        }

        fwrite($fp, PHP_EOL);

        foreach ($graph->getEdges() as $edge) {
            $u = 0;
            $v = 0;
            foreach ($vertices as $i => $vertex) {
                if ($vertex === $edge->from) {
                    $u = $i;
                }
                if ($vertex === $edge->to) {
                    $v = $i;
                }
            }

            fwrite($fp, sprintf('  %d -> %d [penwidth=2, label=%d]%s', $u, $v, $edge->weight, PHP_EOL));
        }

        fwrite($fp, '}');
        fclose($fp);
    }
}