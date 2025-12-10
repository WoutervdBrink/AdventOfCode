<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use JetBrains\PhpStorm\Immutable;

#[Immutable] class Rule
{
    private array $alternatives;

    public function __construct(array $alternatives)
    {
        $this->alternatives = $alternatives;
    }

    public function getAlternatives(): array
    {
        return $this->alternatives;
    }

    public static function fromSpecification(string $specification): Rule
    {
        $spec = explode('|', $specification);

        $alternatives = [];

        foreach ($spec as $alternative) {
            $alternative = trim($alternative);
            if ($alternative[0] === '"') {
                // "a" -> a
                $alternatives[] = $alternative[1];
            } else {
                $alternatives[] = array_map(
                    fn (string $id): int => intval($id),
                    explode(' ', $alternative)
                );
            }
        }

        return new Rule($alternatives);
    }
}
