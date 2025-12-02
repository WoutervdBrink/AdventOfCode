<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use ArrayIterator;
use Ds\Vector;
use Ds\Map;
use Ds\Set;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

/**
 * A directed weighted graph. The graph contains vertices connected by edges.
 */
class Graph implements IteratorAggregate
{
    /**
     * @var Set<Vertex> The vertices belonging to this graph.
     */
    private Set $vertices;

    /**
     * @var Map<Vertex, Map<Vertex, Edge>> The edges between the vertices in this graph.
     */
    private Map $edges;

    /**
     * @var int The label to be used when automatically generating one.
     */
    private int $nextLabel;

    /**
     * Construct a new graph.
     */
    public function __construct()
    {
        $this->vertices = new Set();

        $this->edges = new Map();

        $this->nextLabel = 0;
    }

    /**
     * Create a vertex and add it to this graph.
     *
     * @param string|null $label The label of the vertex. Does not have to be unique among the graph.
     * @param mixed $value The value associated with the vertex.
     * @return Vertex The newly created vertex.
     */
    public function createVertex(?string $label = null, mixed $value = null): Vertex
    {
        $vertex = new Vertex($this, $label ?? (string)$this->nextLabel++, $value);
        $this->vertices->add($vertex);
        return $vertex;
    }

    /**
     * Add an edge to this graph.
     *
     * If the edge already exists, its weight is updated to the supplied weight.
     *
     * @param Vertex $from The source vector for this edge.
     * @param Vertex $to The target vector for this edge.
     * @param int $weight The weight of the edge.
     * @return void
     */
    public function addEdge(Vertex $from, Vertex $to, int $weight = 1): void
    {
        if ($this->edges->hasKey($from)) {
            if ($this->edges->get($from)->hasKey($to)) {
                $this->edges->get($from)->get($to)->weight = $weight;
                return;
            }
        } else {
            $this->edges->put($from, new Map());
        }

        $edge = new Edge($from, $to, $weight);
        $this->edges->get($from)->put($to, $edge);
    }

    /**
     * Get the vertices in this graph.
     *
     * @return list<Vertex>
     */
    public function getVertices(): array
    {
        return $this->vertices->toArray();
    }

    /**
     * Get the edges in this graph.
     *
     * @return list<Edge>
     */
    public function getEdges(): array
    {
        $edges = [];

        foreach ($this->edges->values() as $map) {
            $edges = array_merge($edges, $map->values()->toArray());
        }

        return $edges;
    }

    public function hasEdge(Vertex $from, Vertex $to): bool
    {
        if (!$this->edges->hasKey($from)) {
            return false;
        }

        return $this->edges->get($from)
            ->hasKey($to);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return $this->vertices->getIterator();
    }

    public function __debugInfo(): ?array
    {
        return [
            'vertices' => $this->vertices,
            'edges' => $this->edges,
        ];
    }

    /**
     * Get all neighbors of a vertex.
     *
     * A neighbor is any vertex v for which there exists an edge (u -> v) with u the specified vertex.
     *
     * @param Vertex $from The vertex to query.
     * @return list<Vertex> All vertices which have an edge from the specified vertex to themselves.
     */
    public function getNeighbors(Vertex $from): array
    {
        if (!$this->edges->hasKey($from)) {
            return [];
        }

        return $this->edges->get($from)->values()
            ->map(fn (Edge $edge): Vertex => $edge->to)
            ->toArray();
    }

    public function getIncidenceFrom(Vertex $vertex): int
    {
        if (!$this->edges->hasKey($vertex)) {
            return 0;
        }

        return $this->edges->get($vertex)->count();
    }
}