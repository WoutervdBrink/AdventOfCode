<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

/**
 * A vertex belonging to a graph. The vertex has a label, an optional value, and zero or more edges towards other
 * vertices in the graph.
 *
 * The label is semi-optional. If not given, the label will be generated, such that it is unique among other vertices
 * that have an automatically generated label. However, a label need not be unique among all the graph's vertices. The
 * label is used when displaying the graph.
 *
 * The value is optional. It can be set and queried, but is ignored when displaying the graph. This makes it possible
 * to associate values of any type to a graph's vertices without cluttering its visual representation.
 *
 * Edges are always directional. To create an undirected graph, simply add the reverse edge.
 */
class Vertex
{
    /**
     * @var Graph The graph to which this vertex belongs.
     */
    public readonly Graph $graph;

    /**
     * @var string The label of this vertex. Does not have to be unique among the graph.
     */
    public readonly string $label;

    /**
     * @var mixed The value associated with this vertex.
     */
    public mixed $value;

    /**
     * Construct a new graph vertex.
     *
     * @param  Graph  $graph  The graph to which the vertex belongs.
     * @param  string  $label  The label of the vertex. Does not have to be unique among the graph.
     * @param  mixed|null  $value  The value associated with the vertex.
     */
    public function __construct(Graph $graph, string $label, mixed $value = null)
    {
        $this->graph = $graph;

        $this->label = $label;

        $this->value = $value;
    }

    /**
     * Add an edge from this vertex to another vertex.
     */
    public function addEdgeTo(Vertex $other, int $weight = 1): void
    {
        $this->graph->addEdge($this, $other, $weight);
    }

    /**
     * Query whether this vertex is adjacent to another vertex. Here, adjacency means there exists an edge with this
     * vertex as its source, and the other vertex as its target.
     */
    public function isAdjacentTo(Vertex $other): bool
    {
        return $this->graph->hasEdge($this, $other);
    }

    /**
     * Get the neighbors of this vertex. Here, a neighbor is any vertex this vertex has an edge to. Consequently,
     * vertices which have an edge pointing towards this vertex will not be included in the result.
     *
     * @return list<Vertex>
     */
    public function getNeighbors(): array
    {
        return $this->graph->getNeighbors($this);
    }

    /**
     * Get the amount of neighbors this vertex has. Here, a neighbor is any vertex this vertex has an edge to.
     * Consequently, vertices which have an edge pointing towards this vertex will not be included in the result.
     *
     * @return int The amount of neighbors of this vertex.
     */
    public function getIncidenceFrom(): int
    {
        return $this->graph->getIncidenceFrom($this);
    }

    public function __debugInfo(): ?array
    {
        return [
            'label' => $this->label,
            'value' => $this->value,
            'edges' => $this->edges,
        ];
    }
}
