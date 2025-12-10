<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\CPU;
use Knevelina\AdventOfCode\Data\Year2020\Instruction;
use Knevelina\AdventOfCode\Data\Year2020\Program;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CPU::class)]
class CPUTest extends TestCase
{
    public static function instructions(): array
    {
        return [
            ['nop +0', 1, 0],
            ['acc +1', 1, 1],
            ['acc -1', 1, -1],
            ['jmp -4', -4, 0],
            ['jmp +7', 7, 0],
        ];
    }

    #[Test]
    #[DataProvider('instructions')]
    public function it_executes_instructions(string $instruction, int $pc, int $accumulator): void
    {
        $program = Program::fromSpecification($instruction);
        $cpu = new CPU($program);

        $cpu->step();

        $this->assertEquals($pc, $cpu->getPc());
        $this->assertEquals($accumulator, $cpu->getAccumulator());
    }

    #[Test]
    public function it_solves_the_halting_problem(): void
    {
        $forever = new CPU(Program::fromSpecification("nop +0\njmp -1"));
        $once = new CPU(Program::fromSpecification("nop +0\neof +0"));

        $this->assertFalse($forever->terminates());
        $this->assertTrue($once->terminates());
    }

    #[Test]
    public function it_rejects_invalid_instructions(): void
    {
        $invalid = new Program;
        $invalid->addInstruction(new Instruction(1000, 0));

        $cpu = new CPU($invalid);

        $this->expectExceptionMessage('Invalid operation');

        $cpu->step();
    }

    #[Test]
    public function it_stops_at_eof(): void
    {
        $program = Program::fromSpecification('eof +0');
        $cpu = new CPU($program);

        $this->assertFalse($cpu->step());
        $this->assertFalse($cpu->step());
    }
}
