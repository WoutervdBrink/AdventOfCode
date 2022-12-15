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
    /**
     * Construct a new edge.
     *
     * @param Vertex $from The source vertex.
     * @param Vertex $to The target vertex.
     * @param int $weight The weight associated with this edge.
     */
    public function __construct(
        private readonly Vertex $from,
        private readonly Vertex $to,
        private int $weight = 1
    ) {
    }

    /**
     * Get the other end of the edge, given one of the vertices of the edge.
     *
     * If the given edge is the source, the target is given, and vice versa. If the vertex is not part of the edge, an
     * exception is thrown.
     *
     * @param Vertex $v
     * @return Vertex
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
     * @param Vertex $v
     * @return bool
     */
    public function isIncidentWith(Vertex $v): bool
    {
        return $this->from === $v || $this->to === $v;
    }

    /**
     * Get the source vertex of the edge.
     *
     * @return Vertex
     */
    public function getFrom(): Vertex
    {
        return $this->from;
    }

    /**
     * Get the target vertex of the edge.
     *
     * @return Vertex
     */
    public function getTo(): Vertex
    {
        return $this->to;
    }

    /**
     * Get the weight of the edge. This is 1 by default.
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set the weight of the edge.
     *
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @inheritDoc
     */
    public function __debugInfo(): ?array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'weight' => $this->weight,
        ];
    }
}