<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Instruction;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use Knevelina\AdventOfCode\Data\Year2020\Program;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\Program
 */
class ProgramTest extends TestCase
{
    /** @test */
    function it_adds_instructions(): void
    {
        $program = new Program();
        $ins0 = new Instruction(Operation::NOP, 0);
        $ins1 = new Instruction(Operation::ACC, 2);

        $program->addInstruction($ins0);
        $program->addInstruction($ins1);

        $this->assertEquals($ins0, $program->getInstruction(0));
        $this->assertEquals($ins1, $program->getInstruction(1));
    }

    /** @test */
    function it_returns_eof_for_undefined_instructions(): void
    {
        $program = new Program();
        $program->addInstruction(new Instruction(Operation::ACC, 2));

        $ins = $program->getInstruction(1);

        $this->assertEquals(Operation::EOF, $ins->getOperation());
    }

    /** @test */
    function it_parses_programs(): void
    {
        $program = Program::fromSpecification("acc +5\njmp -2\nnop +0");

        $ins0 = $program->getInstruction(0);
        $ins1 = $program->getInstruction(1);
        $ins2 = $program->getInstruction(2);

        $this->assertEquals(Operation::ACC, $ins0->getOperation());
        $this->assertEquals(5, $ins0->getArgument());

        $this->assertEquals(Operation::JMP, $ins1->getOperation());
        $this->assertEquals(-2, $ins1->getArgument());

        $this->assertEquals(Operation::NOP, $ins2->getOperation());
        $this->assertEquals(0, $ins2->getArgument());
    }

    /** @test */
    function it_has_a_size(): void
    {
        $program = new Program();
        $instruction = new Instruction(Operation::NOP, 0);

        $this->assertEquals(0, $program->getSize());

        $program->addInstruction($instruction);

        $this->assertEquals(1, $program->getSize());

        $program->addInstruction($instruction);
        $program->addInstruction($instruction);
        $program->addInstruction($instruction);

        $this->assertEquals(4, $program->getSize());
    }

    /** @test */
    function it_replaces_instructions(): void
    {
        $program = new Program();
        $ins0 = new Instruction(Operation::NOP, 0);
        $ins1 = new Instruction(Operation::NOP, 1);
        $ins2 = new Instruction(Operation::NOP, 2);
        $ins3 = new Instruction(Operation::NOP, 3);

        $program->addInstruction($ins0);
        $program->addInstruction($ins1);
        $program->addInstruction($ins2);

        $this->assertEquals($ins2, $program->getInstruction(2));

        $program->setInstruction(2, $ins3);

        $this->assertEquals($ins3, $program->getInstruction(2));
    }

    /** @test */
    function it_clones_programs(): void
    {
        $program = new Program();
        $ins0 = new Instruction(Operation::NOP, 0);
        $ins1 = new Instruction(Operation::NOP, 1);
        $program->addInstruction($ins0);
        $program->addInstruction($ins1);

        $programClone = $program->clone();

        $this->assertEquals(2, $programClone->getSize());
        $this->assertEquals($ins0, $programClone->getInstruction(0));
        $this->assertEquals($ins1, $programClone->getInstruction(1));
    }
}