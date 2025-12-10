<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use RuntimeException;

class ShuntingYard
{
    const LEFT = 0;

    const RIGHT = 1;

    private array $operators;

    private array $precedence;

    private array $associativity;

    public function __construct()
    {
        $this->operators = [];
        $this->precedence = ['(' => 0, ')' => 0];
        $this->associativity = [];
    }

    public function addOperator(string $operator, int $precedence, int $associativity): self
    {
        $this->operators[] = $operator;
        $this->precedence[$operator] = $precedence;
        $this->associativity[$operator] = $associativity;

        return $this;
    }

    public function convert(string $expression): array
    {
        $tokens = [];

        for ($i = 0; $i < strlen($expression); $i++) {
            $chr = $expression[$i];

            if (trim($chr) === '') {
                continue;
            }

            if (in_array($chr, $this->operators) || $chr === '(' || $chr === ')') {
                $tokens[] = $chr;
            } else {
                $tokens[] = intval($chr);
            }
        }

        $outputQueue = [];
        $operatorStack = [];

        while ($tokens) {
            $token = array_shift($tokens);

            if (is_numeric($token)) {
                $outputQueue[] = $token;
            } elseif (in_array($token, $this->operators)) {
                while ($operatorStack &&
                    $this->precedence[end(
                        $operatorStack
                    )] >= $this->precedence[$token] + $this->associativity[$token]) {
                    $outputQueue[] = array_pop($operatorStack);
                }

                $operatorStack[] = $token;
            } elseif ($token === '(') {
                $operatorStack[] = $token;
            } elseif ($token === ')') {
                while (end($operatorStack) !== '(') {
                    $outputQueue[] = array_pop($operatorStack);

                    if (! $operatorStack) {
                        throw new RuntimeException('Mismatched parentheses!');
                    }
                }

                array_pop($operatorStack);
            } else {
                throw new RuntimeException(sprintf('Unexpected token "%s"', $token));
            }
        }

        while ($operatorStack) {
            $token = array_pop($operatorStack);

            if ($token === '(') {
                throw new RuntimeException('Mismatched parentheses!');
            }

            $outputQueue[] = $token;
        }

        return $outputQueue;
    }
}
