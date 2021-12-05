<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Grammar;

class Day19 implements PuzzleSolver
{
    private Grammar $grammar;
    private array $cache;

    private function getRegex(int $id): string
    {
        if (!isset($this->cache[$id])) {
            $rule = $this->grammar->getRule($id);

            $regex = count($rule->getAlternatives()) > 1 ? '(' : '';

            foreach ($rule->getAlternatives() as $key => $alternative) {
                if ($key !== 0) {
                    $regex .= '|';
                }

                if (is_array($alternative)) {
                    $regex .= implode('', array_map(fn(int $id): string => self::getRegex($id), $alternative));
                } else {
                    $regex .= $alternative;
                }
            }

            $this->cache[$id] = $regex . (count($rule->getAlternatives()) > 1 ? ')' : '');
        }

        return $this->cache[$id];
    }

    public function part1(string $input): int
    {
        $input = explode("\n\n", $input, 2);

        $rules = $input[0];
        $strings = explode("\n", $input[1]);

        $this->cache = [];
        $this->grammar = Grammar::fromSpecification($rules);

        $regex = $this->getRegex(0);
        $regex = '/^' . $regex . '$/';

        $sum = 0;

        foreach ($strings as $string) {
            if (preg_match($regex, $string)) {
                $sum++;
            }
        }

        return $sum;
    }

    public function part2(string $input): int
    {
        $input = explode("\n\n", $input, 2);

        $rules = $input[0];
        $strings = explode("\n", $input[1]);

        $this->cache = [];
        $this->grammar = Grammar::fromSpecification($rules);

        $this->cache[8] = '(' . $this->getRegex(42) . '+)';

        $reg42 = $this->getRegex(42);
        $reg31 = $this->getRegex(31);

        $this->cache[11] = '(?<X11>' . $reg42 . '(?&X11)' . $reg31 . '|' . $reg42 . $reg31 . ')';

        $regex = $this->getRegex(0);
        $regex = '/^' . $regex . '$/';

        $sum = 0;

        foreach ($strings as $string) {
            if (preg_match($regex, $string)) {
                $sum++;
            }
        }

        return $sum;
    }
}