<?php


namespace Knevelina\AdventOfCode\Tests\Data\Year2020;


use InvalidArgumentException;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\Operation
 */
class OperationTest extends TestCase
{
    public function mnemonics(): array
    {
        return [
            ['eof', Operation::EOF],
            ['nop', Operation::NOP],
            ['acc', Operation::ACC],
            ['jmp', Operation::JMP]
        ];
    }

    /**
     * @test
     * @dataProvider mnemonics
     * @param string $mnemonic
     * @param int $expected
     */
    function it_translates_mnemonics(string $mnemonic, int $expected): void
    {
        $this->assertEquals($expected, Operation::getOperationForMnemonic($mnemonic));
    }

    /**
     * @dataProvider mnemonics
     * @test
     * @param string $expected
     * @param int $operation
     */
    function it_translates_operations(string $expected, int $operation): void
    {
        $this->assertEquals($expected, Operation::getMnemonicForOperation($operation));
    }
    
    /** @test */
    function it_rejects_unknown_mnemonics(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Invalid mnemonic "invalid"!'));

        /** @noinspection PhpExpressionResultUnusedInspection */
        Operation::getOperationForMnemonic('invalid');
    }
}