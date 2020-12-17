<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use Knevelina\AdventOfCode\InputManipulator;

class Tickets
{
    /**
     * @var array<array{field: string, ranges: array{array{int, int}, array{int, int}}}>
     */
    private array $fields;

    /**
     * @var array<array<int>>
     */
    private array $tickets;

    /**
     * @var array<int, bool>
     */
    private array $validationCache;

    /**
     * @param array<array{field: string, ranges: array{array{int, int}, array{int, int}}}> $fields
     * @param int[][] $tickets
     */
    public function __construct(array $fields, array $tickets)
    {
        $this->fields = $fields;
        $this->tickets = $tickets;

        $this->validationCache = [];
    }

    public static function fromSpecification(string $input): Tickets
    {
        $input = InputManipulator::splitLines($input);
        $state = 'fields';

        $fields = [];
        $tickets = [];

        foreach ($input as $line) {
            if (strlen(trim($line)) === 0) {
                $state = match ($state) {
                    'fields' => 'my',
                    'my' => 'nearby',
                    default => 'done'
                };

                continue;
            }

            if (substr($line, 0, 4) === 'your' || substr($line, 0, 6) === 'nearby') {
                continue;
            }

            switch ($state) {
                case 'fields':
                    $fields[] = self::parseField($line);
                    break;
                case 'my':
                case 'nearby':
                    $tickets[] = self::parseTicket($line);
                    break;
            }
        }

        return new Tickets($fields, $tickets);
    }

    /**
     * @param string $field
     * @return array{field: string, ranges: array{array{int, int}, array{int, int}}}
     */
    private static function parseField(string $field): array
    {
        if (!preg_match('/^([a-z ]+): (\d+)-(\d+) or (\d+)-(\d+)$/', $field, $matches)) {
            throw new InvalidArgumentException(sprintf('Invalid field specification "%s"', $field));
        }

        return [
            'field' => $matches[1],
            'ranges' => [
                [intval($matches[2]), intval($matches[3])],
                [intval($matches[4]), intval($matches[5])]
            ]
        ];
    }

    /**
     * @param string $line
     * @return int[]
     */
    private static function parseTicket(string $line): array
    {
        return array_map(fn(string $val): int => intval($val), explode(',', $line));
    }

    /**
     * @return array<array{field: string, ranges: array{array{int, int}, array{int, int}}}> $fields
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array<array<int>>
     */
    public function getTickets(): array
    {
        return $this->tickets;
    }

    /**
     * @param array<int> $ticket
     * @return bool
     */
    public function isValid(array $ticket): bool
    {
        foreach ($ticket as $value) {
            if (!$this->validates($value)) {
                return false;
            }
        }

        return true;
    }

    public function validates(int $value): bool
    {
        if (!isset($this->validationCache[$value])) {
            $this->validationCache[$value] = false;
            foreach ($this->fields as $field) {
                foreach ($field['ranges'] as $range) {
                    if ($value >= $range[0] && $value <= $range[1]) {
                        $this->validationCache[$value] = true;
                    }
                }
            }
        }

        return $this->validationCache[$value];
    }

    public function passesField(array $field, int $value): bool
    {
        foreach ($field['ranges'] as $range) {
            if ($value >= $range[0] && $value <= $range[1]) {
                return true;
            }
        }
        return false;
    }
}