<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Bag;
use Knevelina\AdventOfCode\Data\Year2020\Tree;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day07 implements PuzzleSolver
{
    private array $bagMap = [];

    #[Override]
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $this->bagMap = [];

        $bags = array_map(fn (string $input): Bag => Bag::fromSpecification($input), $input);

        foreach ($bags as $bag) {
            $tree = $this->getTreeForColor($bag->getColor());

            foreach ($bag->getAcceptableColors() as $color => $label) {
                $this->getTreeForColor($color)->addChild($label, $tree);
            }
        }

        $amount = 0;
        $cache = [];

        $this->getTreeForColor('shiny gold')->walk(
            function (int $label, Tree $tree) use (&$cache, &$amount) {
                if (isset($cache[$tree->getId()])) {
                    return;
                }

                $amount++;

                $cache[$tree->getId()] = true;
            }
        );

        return $amount;
    }

    protected function getTreeForColor(string $color): Tree
    {
        if (! isset($this->bagMap[$color])) {
            $this->bagMap[$color] = new Tree($color);
        }

        return $this->bagMap[$color];
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $this->bagMap = [];

        $bags = array_map(fn (string $input): Bag => Bag::fromSpecification($input), $input);

        foreach ($bags as $bag) {
            $tree = $this->getTreeForColor($bag->getColor());

            foreach ($bag->getAcceptableColors() as $color => $label) {
                $tree->addChild($label, $this->getTreeForColor($color));
            }
        }

        // Ignore root
        return $this->walkPart2($this->getTreeForColor('shiny gold'), 1) - 1;
    }

    protected function walkPart2(Tree $tree, int $multiplier): int
    {
        $sum = $multiplier;

        foreach ($tree->getChildren() as $link) {
            $label = $link[0];
            $child = $link[1];

            $sum += $multiplier * $this->walkPart2($child, $label);
        }

        return $sum;
    }
}
