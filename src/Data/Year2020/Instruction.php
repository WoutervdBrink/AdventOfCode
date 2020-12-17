<?php


namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

#[Immutable]
class Instruction
{
    public function __construct(private int $operation, private int $argument)
    {
    }

    public static function fromSpecification(string $specification): Instruction
    {
        if (!preg_match('/^([a-z]+) (([+\-])\d+)$/', $specification, $matches)) {
            throw new InvalidArgumentException(sprintf('Invalid instruction format "%s"!', $specification));
        }

        return new Instruction(Operation::getOperationForMnemonic($matches[1]), intval($matches[2]));
    }

    #[Pure] public function __toString(): string
    {
        return sprintf(
            '%s %s%d',
            Operation::getMnemonicForOperation($this->getOperation()),
            $this->getArgument() >= 0 ? '+' : '',
            $this->getArgument()
        );
    }

    #[Pure] public function getOperation(): int
    {
        return $this->operation;
    }

    #[Pure] public function getArgument(): int
    {
        return $this->argument;
    }
}