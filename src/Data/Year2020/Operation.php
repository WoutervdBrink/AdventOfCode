<?php


namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Operation
{
    const EOF = 0;
    const NOP = 1;
    const ACC = 2;
    const JMP = 3;

    #[Pure] public static function getOperationForMnemonic(string $mnemonic): int
    {
        return match ($mnemonic) {
            'eof' => self::EOF,
            'nop' => self::NOP,
            'acc' => self::ACC,
            'jmp' => self::JMP,
            default => throw new InvalidArgumentException(sprintf('Invalid mnemonic "%s"!', $mnemonic))
        };
    }

    #[Pure] public static function getMnemonicForOperation(int $operation): string
    {
        return match ($operation) {
            self::EOF => 'eof',
            self::NOP => 'nop',
            self::ACC => 'acc',
            self::JMP => 'jmp',
            default => throw new InvalidArgumentException(sprintf('Invalid operation %d!', $operation))
        };
    }
}