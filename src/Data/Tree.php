<?php


namespace Knevelina\AdventOfCode\Data;

class Tree
{
    private string $id;

    private ?Tree $parent;

    private array $children;

    public function __construct(string $id, ?Tree $parent = null)
    {
        $this->id = $id;
        $this->parent = $parent;
        $this->children = [];
    }

    public function addChild(int $label, Tree $child)
    {
        $this->children[] = [$label, $child];
        $child->setParent($this);
    }

    /**
     * @param Tree|null $parent
     */
    public function setParent(?Tree $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return string
     * @noinspection PhpUnused
     */
    public function __toString(): string
    {
        $string = $this->getId();
        foreach ($this->getChildren() as $link) {
            $label = $link[0];
            $child = $link[1];

            $string .= ' '.$label.':'.$child->__toString();
        }

        return '{'.$string.'}';
    }

    public function walk(callable $callback): void
    {
        foreach ($this->children as $link) {
            $label = $link[0];
            $child = $link[1];

            $callback($label, $child);

            $child->walk($callback);
        }
    }
}