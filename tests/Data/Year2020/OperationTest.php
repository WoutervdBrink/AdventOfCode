<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Operation::class)]
class OperationTest extends TestCase
{
    public static function mnemonics(): array
    {
        return [
            ['eof', Operation::EOF],
            ['nop', Operation::NOP],
            ['acc', Operation::ACC],
            ['jmp', Operation::JMP],
        ];
    }

    #[Test]
    #[DataProvider('mnemonics')]
    public function it_translates_mnemonics(string $mnemonic, int $expected): void
    {
        $this->assertEquals($expected, Operation::getOperationForMnemonic($mnemonic));
    }

    #[Test]
    #[DataProvider('mnemonics')]
    public function it_translates_operations(string $expected, int $operation): void
    {
        $this->assertEquals($expected, Operation::getMnemonicForOperation($operation));
    }

    #[Test]
    public function it_rejects_unknown_mnemonics(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Invalid mnemonic "invalid"!'));

        /** @noinspection PhpExpressionResultUnusedInspection */
        Operation::getOperationForMnemonic('invalid');
    }
}
