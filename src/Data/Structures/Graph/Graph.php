<?php

namespace Knevelina\AdventOfCode\Data\Structures\Graph;

use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

/**
 * A directed non-simple graph. The graph contains vertices connected by edges.
 */
class Graph implements IteratorAggregate
{
    /**
     * @var array The vertices belonging to this graph.
     */
    private array $vertices;

    /**
     * @var array The edges between the vertices in this graph.
     */
    private array $edges;

    /**
     * @var int The label to be used when automatically generating one.
     */
    private int $nextLabel;

    /**
     * Construct a new graph.
     */
    public function __construct()
    {
        $this->vertices = [];

        $this->edges = [];

        $this->nextLabel = 0;
    }

    /**
     * Query whether two vertices are adjacent, meaning there exists an edge from one to the other or vice versa.
     * Directionality of the edge is not considered.
     *
     * @param Vertex $u
     * @param Vertex $v
     * @return bool
     */
    public function isAdjacent(Vertex $u, Vertex $v): bool
    {
        return $u->isAdjacentTo($v) || $v->isAdjacentTo($u);
    }

    /**
     * Create a vertex and add it to this graph.
     *
     * @param string|null $label The label of the vertex. Does not have to be unique among the graph.
     * @param mixed|null $value The value associated with the vertex.
     * @return void
     */
    public function createVertex(?string $label = null, mixed $value = null): void
    {
        $this->addVertex(new Vertex($this, $label, $value));
    }

    /**
     * Add a vertex to this graph. The vertex has to belong to this graph.
     *
     * @param Vertex $v
     * @return void
     */
    public function addVertex(Vertex $v): void
    {
        if (in_array($v, $this->vertices, true)) {
            return;
        }

        if ($v->getGraph() !== $this) {
            throw new InvalidArgumentException('A vertex must belong to the graph it is added to');
        }

        $this->vertices[] = $v;
    }

    /**
     * Add an edge to this graph. The edge's vertices will be added to this graph, if required.
     *
     * @param Edge $e
     * @return void
     */
    public function addEdge(Edge $e): void
    {
        $this->addVertex($from = $e->getFrom());
        $this->addVertex($to = $e->getTo());

        $from->addIncidence($e);
        $to->addIncidence($e);

        if (in_array($e, $this->edges, true)) {
            return;
        }

        $this->edges[] = $e;
    }

    /**
     * Get the vertices in this graph.
     *
     * @return array<Vertex>
     */
    public function getVertices(): array
    {
        return $this->vertices;
    }

    /**
     * Get the edges in this graph.
     *
     * @return array<Edge>
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    /**
     * Get the next label to be used for an automatically generated vertex label.
     *
     * This method is not pure and will mutate the next label. It is meant for internal use only, but as PHP does not
     * have package-level visibility, it is declared with public visibility.
     *
     * @return string
     * @internal
     */
    public function getNextLabel(): string
    {
        return (string)$this->nextLabel++;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->vertices);
    }

    public function __debugInfo(): ?array
    {
        return [
            'vertices' => $this->vertices
        ];
    }
}