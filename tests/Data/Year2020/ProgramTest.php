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
}