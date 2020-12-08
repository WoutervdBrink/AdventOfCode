<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\CPU;
use Knevelina\AdventOfCode\Data\Year2020\Program;
use PHPUnit\Framework\TestCase;

class CPUTest extends TestCase
{

    public function instructions(): array
    {
        return [
            ['nop +0', 1, 0],
            ['acc +1', 1, 1],
            ['acc -1', 1, -1],
            ['jmp -4', -4, 0],
            ['jmp +7', 7, 0]
        ];
    }

    /**
     * @dataProvider instructions
     * @test
     * @param string $instruction
     * @param int $pc
     * @param int $accumulator
     */
    function it_executes_instructions(string $instruction, int $pc, int $accumulator): void
    {
        $program = Program::fromSpecification($instruction);
        $cpu = new CPU($program);

        $cpu->step();

        $this->assertEquals($pc, $cpu->getPc());
        $this->assertEquals($accumulator, $cpu->getAccumulator());
    }
}
