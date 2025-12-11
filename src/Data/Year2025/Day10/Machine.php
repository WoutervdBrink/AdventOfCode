<?php

namespace Knevelina\AdventOfCode\Data\Year2025\Day10;

use Ds\Map;
use InvalidArgumentException;
use RuntimeException;

readonly class Machine
{
    public int $size;

    /**
     * @param  bool[]  $lights
     * @param  int[][]  $buttons
     * @param  int[]  $joltage
     */
    public function __construct(
        public array $lights,
        public array $buttons,
        public array $joltage,
    ) {
        $this->size = count($this->lights);
    }

    public function __toString(): string
    {
        $str = '[';
        foreach ($this->lights as $light) {
            $str .= $light ? '#' : '.';
        }
        $str .= ']';

        foreach ($this->buttons as $button) {
            $str .= ' ('.implode(',', $button).')';
        }

        return $str.' {'.implode(',', $this->joltage).'}';
    }

    public function getFewestButtonPresses(): int
    {
        /** @var Map<bool[], int> $reachable */
        $reachable = new Map;

        $initial = array_fill(0, $this->size, false);
        $reachable->put($initial, 0);

        /** @var bool[][] $queue */
        $queue = [$initial];

        while (! empty($queue)) {
            $state = array_shift($queue);

            if ($state === $this->lights) {
                return $reachable->get($state);
            }

            foreach ($this->buttons as $button) {
                $toggled = self::applyButton($state, $button);
                if (! $reachable->hasKey($toggled)) {
                    $reachable->put($toggled, $reachable->get($state) + 1);
                    $queue[] = $toggled;
                }
            }
        }

        throw new RuntimeException('Could not find valid button presses for machine '.$this);
    }

    /**
     * @param  bool[]  $state
     * @param  int[]  $button
     * @return bool[]
     */
    private static function applyButton(array $state, array $button): array
    {
        foreach ($button as $i) {
            $state[$i] = ! $state[$i];
        }

        return $state;
    }

    public static function fromSpecification(string $line): self
    {
        $elements = explode(' ', $line);
        if (count($elements) <= 2) {
            throw new InvalidArgumentException('Line '.$line.' is invalid: should have at least space-separated elements.');
        }

        $lightDiagram = array_shift($elements);

        /** @var bool[] $lights */
        $lights = [];
        for ($i = 1; $i < strlen($lightDiagram) - 1; $i++) {
            $lights[] = $lightDiagram[$i] === '#';
        }

        /** @var int[] $joltageRequirements */
        $joltageRequirements = array_map(
            'intval',
            explode(
                ',',
                substr(array_pop($elements), 1, -1)
            )
        );

        /** @var int[][] $buttons */
        $buttons = array_map(function (string $button): array {
            return array_map('intval', explode(',', substr($button, 1, -1)));
        }, $elements);

        usort($buttons, fn ($a, $b) => count($a) <=> count($b));

        return new self($lights, $buttons, $joltageRequirements);
    }
}
