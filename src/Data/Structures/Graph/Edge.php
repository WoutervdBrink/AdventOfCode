<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use InvalidArgumentException;

/**
 * An edge between two vertices in a graph. The edge has a source vertex, a target vertex, and an optional weight.
 *
 * The existence of an edge from a source to a target implies you can 'visit' the target vertex from the source vertex.
 *
 * The optional weight is 1 by default and can be set and queried.
 */
class Edge
{
    public readonly Graph $graph;

    /**
     * Construct a new edge.
     *
     * The provided vertices must belong to the same graph.
     *
     * @param Vertex $from The source vertex of this edge.
     * @param Vertex $to The target vertex of this edge.
     * @param int $weight The initial weight of this edge.
     * @throws InvalidArgumentException if the edges do not belong to the same graph.
     */
    public function __construct(
        /**
         * @var Vertex The source vertex of this edge.
         */
        public readonly Vertex $from,

        /**
         * @var Vertex The target vertex of this edge.
         */
        public readonly Vertex $to,

        /**
         * @var int The weight of this edge.
         */
        public int             $weight,
    )
    {
        if (($graph = $from->graph) !== $to->graph) {
            throw new InvalidArgumentException('Edge vertices must belong to the same graph');
        }

        $this->graph = $graph;
    }

    /**
     * Get the other end of the edge, given one of the vertices of the edge.
     *
     * If the given edge is the source, the target is given, and vice versa. If the vertex is not part of the edge, an
     * exception is thrown.
     *
     * @param Vertex $v The vertex for which to find the other end.
     * @return Vertex The other end of the edge. Guaranteed not to be equal to <code>$v</code>.
     * @throws InvalidArgumentException if the specified vertex is not part of this edge.
     */
    public function getOtherEnd(Vertex $v): Vertex
    {
        if ($this->from === $v) {
            return $this->to;
        }

        if ($this->to === $v) {
            return $this->from;
        }

        throw new InvalidArgumentException('The given vertex is not part of this edge');
    }

    /**
     * Query whether the edge contains this vertex as its source or target.
     *
     * @param Vertex $v The vertex to query.
     * @return bool <code>true</code> when this edge has the specified vertex as either its source or its target;
     * <code>false</code> otherwise.
     */
    public function isIncidentWith(Vertex $v): bool
    {
        return $this->from === $v || $this->to === $v;
    }

    public function __debugInfo(): ?array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'weight' => $this->weight,
        ];
    }
}