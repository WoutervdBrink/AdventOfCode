<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Instruction;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Instruction::class)]
class InstructionTest extends TestCase
{
    #[DataProvider('invalidInstructions')]
    #[DataProvider('invalidInstructions')]
    public function it_rejects_invalid_instructions(string $instruction): void
    {
        $this->expectExceptionMessage('Invalid instruction format');

        Instruction::fromSpecification($instruction);
    }

    #[Test]
    #[DataProvider('instructions')]
    public function it_parses_specifications(string $specification, int $operation, int $argument): void
    {
        $instruction = Instruction::fromSpecification($specification);

        $this->assertEquals($operation, $instruction->getOperation());
        $this->assertEquals($argument, $instruction->getArgument());
        $this->assertEquals($specification, $instruction->__toString());
    }

    public static function instructions(): array
    {
        return [
            ['nop +0', Operation::NOP, 0],
            ['nop -3', Operation::NOP, -3],
            ['nop +5', Operation::NOP, 5],
            ['acc +0', Operation::ACC, 0],
            ['acc -1', Operation::ACC, -1],
            ['acc +10', Operation::ACC, 10],
            ['jmp +0', Operation::JMP, 0],
            ['jmp -7', Operation::JMP, -7],
            ['jmp +200', Operation::JMP, 200],
            ['eof +0', Operation::EOF, 0],
            ['eof -10', Operation::EOF, -10],
            ['eof +300', Operation::EOF, 300],
        ];
    }

    public static function invalidInstructions(): array
    {
        return [
            ['eof'],
            ['nop 0'],
            ['nop --1'],
            ['eof ++1'],
        ];
    }
}
