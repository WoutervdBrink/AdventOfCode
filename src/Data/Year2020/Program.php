<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\InputManipulator;

class Program
{
    private array $instructions;

    public function __construct()
    {
        $this->instructions = [];
    }

    public static function fromSpecification(string $specification): Program
    {
        $program = new Program();

        $specification = InputManipulator::splitLines($specification);

        foreach ($specification as $instruction) {
            $program->addInstruction(Instruction::fromSpecification($instruction));
        }

        return $program;
    }

    public function addInstruction(Instruction $instruction): void
    {
        $this->instructions[] = $instruction;
    }

    #[Pure] public function getSize(): int
    {
        return count($this->instructions);
    }

    public function clone(): Program
    {
        $clone = new Program();

        foreach ($this->instructions as $address => $instruction) {
            $clone->setInstruction($address, $instruction);
        }

        return $clone;
    }

    public function setInstruction(int $address, Instruction $instruction): void
    {
        $this->instructions[$address] = $instruction;
    }

    #[Pure] public function getInstruction(int $address): Instruction
    {
        return $this->instructions[$address] ?? new Instruction(Operation::EOF, 0);
    }
}