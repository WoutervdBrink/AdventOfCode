<?php

namespace Knevelina\AdventOfCode\Visuals\Year2020;

use Fhaculty\Graph\Graph;
use Fhaculty\Graph\Vertex;
use Graphp\GraphViz\GraphViz;
use Knevelina\AdventOfCode\Contracts\PuzzleVisualizer;
use Knevelina\AdventOfCode\Data\Year2020\CPU;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use Knevelina\AdventOfCode\Data\Year2020\Program;

class Day08 implements PuzzleVisualizer
{
    private Graph $graph;
    private array $vertices;
    private Program $program;

    private function getVertex(int $address): Vertex
    {
        if (!isset($this->vertices[$address])) {
            $this->vertices[$address] = $this->graph->createVertex($address);
        }

        return $this->vertices[$address];
    }
    public function visualize(string $input, string $path): void
    {
        $this->program = Program::fromSpecification($input);
        $this->graph = new Graph();
        $this->vertices = [];

        for ($address = 0; $address < $this->program->getSize(); $address++) {
            $ins = $this->program->getInstruction($address);
            $vertex = $this->getVertex($address);

            $target = match ($ins->getOperation()) {
                Operation::EOF => $address,
                Operation::JMP => $address + $ins->getArgument(),
                default => $address + 1
            };

            if ($target >= 0 && $target < $this->program->getSize()) {
                $vertex->createEdgeTo($this->getVertex($target));
            }
        }

        $cpu = new CPU($this->program);

        $cache = [];

        while (!isset($cache[$cpu->getPc()])) {
            $cache[$cpu->getPc()] = true;
            $this->getVertex($cpu->getPc())->setAttribute('graphviz.color', 'blue');
            if (!$cpu->step()) {
                break;
            }
        }

        $this->getVertex($this->program->getSize() - 1)->setAttribute('graphviz.color', 'red');

        $viz = new GraphViz();
        $viz->setFormat('svg');
        $file = $viz->createImageFile($this->graph);
        rename($file, $path.'.svg');
    }
}