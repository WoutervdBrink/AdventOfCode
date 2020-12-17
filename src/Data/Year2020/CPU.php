<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use RuntimeException;

class CPU
{
    private int $pc;
    private int $accumulator;
    private Program $program;
    private bool $running;

    public function __construct(Program $program)
    {
        $this->pc = 0;
        $this->accumulator = 0;
        $this->program = $program;
        $this->running = true;
    }

    /**
     * @return int
     */
    public function getPc(): int
    {
        return $this->pc;
    }

    /**
     * @return int
     */
    public function getAccumulator(): int
    {
        return $this->accumulator;
    }

    public function terminates(): bool
    {
        $cache = [];

        while (!isset($cache[$this->pc])) {
            $cache[$this->pc] = true;

            if (!$this->step()) {
                break;
            }
        }

        return !$this->running;
    }

    public function step(): bool
    {
        if (!$this->running) {
            return false;
        }

        $nextPc = $this->pc + 1;
        $nextAccumulator = $this->accumulator;

        $instruction = $this->program->getInstruction($this->pc);

        $argument = $instruction->getArgument();

//        printf("> pc=%04d a=%04d i=%s\n", $this->getPc(), $this->getAccumulator(), $instruction);

        switch ($instruction->getOperation()) {
            case Operation::EOF:
                $this->running = false;
                break;
            case Operation::NOP:
                break;
            case Operation::ACC:
                $nextAccumulator = $this->accumulator + $argument;
                break;
            case Operation::JMP:
                $nextPc = $this->pc + $argument;
                break;
            default:
                throw new RuntimeException(sprintf('Unknown instruction "%s"!', $instruction->__toString()));
        }

        $this->pc = $nextPc;
        $this->accumulator = $nextAccumulator;

//        printf("  pc=%04d a=%04d i=%s\n", $this->getPc(), $this->getAccumulator(), $instruction);

        return $this->running;
    }
}