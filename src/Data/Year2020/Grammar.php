<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Immutable;

#[Immutable] class Grammar
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public static function fromSpecification(string $specification): Grammar
    {
        $rules = [];

        foreach (explode("\n", $specification) as $rule) {
            $rule = explode(': ', $rule, 2);

            $id = intval($rule[0]);
            $spec = $rule[1];

            $rules[$id] = Rule::fromSpecification($spec);
        }

        return new Grammar($rules);
    }

    public function getRule(int $id): Rule
    {
        if (!isset($this->rules[$id])) {
            throw new InvalidArgumentException(sprintf('Rule %d does not exist.', $id));
        }

        return $this->rules[$id];
    }
}