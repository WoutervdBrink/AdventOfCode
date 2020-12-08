<?php


namespace Knevelina\AdventOfCode\Data\Year2015;


use InvalidArgumentException;
use Knevelina\AdventOfCode\InputManipulator;
use RuntimeException;

class WireCollection
{
    private array $wires;
    private array $values;

    public function __construct(string $specification)
    {
        $specification = InputManipulator::splitLines($specification);

        foreach ($specification as $gate) {
            // value|wire -> wire
            if (preg_match('/^([a-z]+|\d+) -> ([a-z]+)$/', $gate, $matches)) {
                $this->addWire($matches[2], WireOperator::VALUE, $matches[1]);
                continue;
            }

            // (wire|value) OP (wire|value) -> wire
            if (preg_match('/^([a-z]+|\d+) (AND|OR|LSHIFT|RSHIFT) ([a-z]+|\d+) -> ([a-z]+)$/', $gate, $matches)) {
                $this->addWire($matches[4], WireOperator::getOperatorForName($matches[2]), $matches[1], $matches[3]);
                continue;
            }

            // NOT (wire|value) -> wire
            if (preg_match('/^NOT ([a-z]+|\d+) -> ([a-z]+)$/', $gate, $matches)) {
                $this->addWire($matches[2], WireOperator::NOT, $matches[1]);
                continue;
            }

            throw new RuntimeException(sprintf('Invalid gate specification "%s".', $gate));
        }
    }

    public function addWire(string $wire, int $operator, int|string ...$operands): void
    {
        $this->values = [];

        if (isset($this->wires[$wire])) {
            throw new InvalidArgumentException(sprintf('Trying to add existing wire "%s"!', $wire));
        }

        $this->wires[$wire] = new Wire($operator, $operands);
    }

    public function getWires(): array
    {
        return $this->wires;
    }

    public function getWire(string $name): ?Wire
    {
        return $this->wires[$name] ?? null;
    }

    public function getValue(string $name): int
    {
        if (!isset($this->values[$name])) {
            $wire = $this->getWire($name);

            if ($wire === null) {
                throw new InvalidArgumentException(sprintf('Trying to get the value of non-existent wire "%s"!', $name));
            }

            $operandValues = [];
            foreach ($wire->getOperands() as $operand) {
                if (is_numeric($operand)) {
                    $operandValues[] = intval($operand);
                } else {
                    $operandValues[] = $this->getValue($operand);
                }
            }

            $value = WireOperator::apply($wire->getOperator(), ...$operandValues);

            $this->values[$name] = $value;
        }

        return $this->values[$name];
    }

    public function removeWire(string $name): void
    {
        $this->values = [];
        unset($this->wires[$name]);
    }
}