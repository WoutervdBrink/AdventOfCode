<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use InvalidArgumentException;

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
    private readonly Graph $graph;

    /** @var array<Edge> */
    private array $edges;

    /**
     * @var string The label of this vertex. Does not have to be unique among the graph.
     */
    private string $label;

    /**
     * @var mixed The value associated with this vertex.
     */
    private mixed $value;

    /**
     * Construct a new graph vertex.
     *
     * @param Graph $graph The graph to which the vertex belongs.
     * @param string|null $label The label of the vertex. Does not have to be unique among the graph.
     * @param mixed|null $value The value associated with the vertex.
     */
    public function __construct(Graph $graph, ?string $label = null, mixed $value = null)
    {
        $this->graph = $graph;

        $this->edges = [];

        $this->label = $label ?? $graph->getNextLabel();
    }

    /**
     * Add an edge from this vertex to another vertex, and from that vertex back to this one, i.e. an undirected edge.
     *
     * @param Vertex $other
     * @param int $weight
     * \     * @return void
     */
    public function addUndirectedEdgeWith(Vertex $other, int $weight = 1): void
    {
        $this->addIncidence(new Edge($this, $other, $weight));
        $this->addIncidence(new Edge($other, $this, $weight));
    }

    /**
     * Associate an edge with this vertex. The edge's source has to be this vertex.
     *
     * @param Edge $e
     * @return void
     */
    public function addIncidence(Edge $e): void
    {
        if ($e->getFrom() !== $this) {
            throw new InvalidArgumentException('The given edge does not have this vertex as its source.');
        }

        if (in_array($e, $this->edges, true)) {
            return;
        }

        $this->edges[] = $e;
    }

    /**
     * Add an edge from this vertex to another vertex.
     *
     * @param Vertex $other
     * @param int $weight
     * @return void
     */
    public function addEdgeTo(Vertex $other, int $weight = 1): void
    {
        $this->addIncidence(new Edge($this, $other, $weight));
    }

    /**
     * Get the graph to which this vertex belongs.
     *
     * @return Graph
     */
    public function getGraph(): Graph
    {
        return $this->graph;
    }

    /**
     * Get the label of this vertex.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get the value associated with this vertex.
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Set the value associated with this vertex.
     *
     * @param mixed $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * Query whether this vertex is adjacent to another vertex. Here, adjacency means there exists an edge with this
     * vertex as its source, and the other vertex as its target.
     *
     * @param Vertex $other
     * @return bool
     */
    public function isAdjacentTo(Vertex $other): bool
    {
        foreach ($this->edges as $edge) {
            if ($edge->getTo() === $other) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the neighbors of this vertex. Here, a neighbor is any vertex this vertex has an edge to. Consequently,
     * vertices which have an edge pointing towards this vertex will not be included in the result.
     *
     * @return array
     */
    public function getNeighbors(): array
    {
        return array_map(fn(Edge $edge): Vertex => $edge->getTo(), $this->edges);
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