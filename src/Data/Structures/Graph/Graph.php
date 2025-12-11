<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use Ds\Map;
use Ds\Set;
use IteratorAggregate;
use Override;
use Traversable;

/**
 * A directed weighted graph. The graph contains vertices connected by edges.
 *
 * @template T Type of values held by the vertices.
 *
 * @implements IteratorAggregate<int, Vertex<T>>
 */
class Graph implements IteratorAggregate
{
    /**
     * @var Set<Vertex<T>> The vertices belonging to this graph.
     */
    private Set $vertices;

    /**
     * @var Map<Vertex<T>, Map<Vertex<T>, Edge<T>>> The edges between the vertices in this graph.
     */
    private Map $edges;

    /**
     * @var Map<Vertex<T>, Map<Vertex<T>, int>> Memoization cache for path calculations.
     *
     * The first key is the source vector; the second key is some vector for which the value is the amount of paths from
     * that vector to the destination vector.
     */
    private Map $pathCache;

    /**
     * @var int The label to be used when automatically generating one.
     */
    private int $nextLabel;

    /**
     * Construct a new graph.
     */
    public function __construct()
    {
        $this->vertices = new Set;

        $this->edges = new Map;

        $this->pathCache = new Map;

        $this->nextLabel = 0;
    }

    private function invalidateCaches(): void
    {
        $this->pathCache->clear();
    }

    /**
     * Create a vertex and add it to this graph.
     *
     * @param  string|null  $label  The label of the vertex. Does not have to be unique among the graph.
     * @param  ?T  $value  The value associated with the vertex.
     * @return Vertex<T> The newly created vertex.
     */
    public function createVertex(?string $label = null, mixed $value = null): Vertex
    {
        $this->invalidateCaches();

        $vertex = new Vertex($this, $label ?? (string) $this->nextLabel++, $value);
        $this->vertices->add($vertex);

        return $vertex;
    }

    /**
     * Add an edge to this graph.
     *
     * If the edge already exists, its weight is updated to the supplied weight.
     *
     * @param  Vertex<T>  $from  The source vector for this edge.
     * @param  Vertex<T>  $to  The target vector for this edge.
     * @param  int  $weight  The weight of the edge.
     */
    public function addEdge(Vertex $from, Vertex $to, int $weight = 1): void
    {
        $this->invalidateCaches();

        if ($this->edges->hasKey($from)) {
            if ($this->edges->get($from)->hasKey($to)) {
                $this->edges->get($from)->get($to)->weight = $weight;

                return;
            }
        } else {
            $this->edges->put($from, new Map);
        }

        $edge = new Edge($from, $to, $weight);
        $this->edges->get($from)->put($to, $edge);
    }

    /**
     * Get the vertices in this graph.
     *
     * @return Vertex<T>[]
     */
    public function getVertices(): array
    {
        return $this->vertices->toArray();
    }

    /**
     * Get the edges in this graph.
     *
     * @return list<Edge<T>>
     */
    public function getEdges(): array
    {
        $edges = [];

        foreach ($this->edges->values() as $map) {
            $edges = array_merge($edges, $map->values()->toArray());
        }

        return $edges;
    }

    /**
     * Query whether there exist an edge between the given vertices.
     *
     * @param  Vertex<T>  $from
     * @param  Vertex<T>  $to
     */
    public function hasEdge(Vertex $from, Vertex $to): bool
    {
        if (! $this->edges->hasKey($from)) {
            return false;
        }

        return $this->edges->get($from)
            ->hasKey($to);
    }

    /**
     * {@inheritDoc}
     */
    #[Override]
    public function getIterator(): Traversable
    {
        return $this->vertices->getIterator();
    }

    public function __debugInfo(): array
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
     * @param  Vertex<T>  $from  The vertex to query.
     * @return list<Vertex<T>> All vertices which have an edge from the specified vertex to themselves.
     */
    public function getNeighbors(Vertex $from): array
    {
        if (! $this->edges->hasKey($from)) {
            return [];
        }

        return $this->edges->get($from)->values()
            ->map(fn (Edge $edge): Vertex => $edge->to)
            ->toArray();
    }

    /**
     * Get the amount of vertices connected to the given vertex.
     *
     * Formally: count all vertices v for which there exists an edge (u -> v) with u the specified vertex.
     *
     * @param  Vertex<T>  $vertex  The vertex to query.
     * @return int The amount of vertices the given vertex connects to.
     */
    public function getIncidenceFrom(Vertex $vertex): int
    {
        if (! $this->edges->hasKey($vertex)) {
            return 0;
        }

        return $this->edges->get($vertex)->count();
    }

    /**
     * Count the amount of distinct paths between the given vertices using DFS.
     *
     * Memoization is applied to speed up the process.
     *
     * @param  Vertex<T>  $from
     * @param  Vertex<T>  $to
     */
    public function countPaths(Vertex $from, Vertex $to): int
    {
        if (! $this->pathCache->hasKey($to)) {
            $this->pathCache->put($to, new Map);
        }

        $cache = $this->pathCache->get($to);

        return $this->countPathsDfs($from, $to, $cache);
    }

    /**
     * Count the amount of distinct paths between the given vertices using DFS.
     *
     * @param  Vertex<T>  $u
     * @param  Vertex<T>  $to
     * @param  Map<Vertex<T>, int>  $cache  Memoization cache.
     */
    private function countPathsDfs(Vertex $u, Vertex $to, Map $cache): int
    {
        if ($u === $to) {
            return 1;
        }

        if ($cache->hasKey($u)) {
            return $cache->get($u);
        }

        $count = 0;

        foreach ($u->getNeighbors() as $v) {
            $count += $this->countPathsDfs($v, $to, $cache);
        }

        $cache->put($u, $count);

        return $count;
    }
}
