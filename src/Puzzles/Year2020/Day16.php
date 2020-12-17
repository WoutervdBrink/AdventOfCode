<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Tickets;

class Day16 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $tickets = Tickets::fromSpecification($input);

        $errors = 0;

        foreach ($tickets->getTickets() as $ticket) {
            foreach ($ticket as $value) {
                if (!$tickets->validates($value)) {
                    $errors += $value;
                }
            }
        }

        return $errors;
    }

    public function part2(string $input): int
    {
        $tickets = Tickets::fromSpecification($input);

        $all = $tickets->getTickets();

        $own = array_shift($all);

        $valid = array_filter($all, fn(array $ticket): bool => $tickets->isValid($ticket));

        $fields = $tickets->getFields();

        $candidates = [];

        foreach ($fields as $i => $field) {
            $candidates[$i] = range(0, 19);
        }

        $fixed = [];

        for ($i = 0; $i < count($valid); $i++) {
            foreach ($valid as $ticket) {
                foreach ($candidates as $field => $range) {
                    $newRange = [];
                    foreach ($range as $i) {
                        if ($tickets->passesField($fields[$field], $ticket[$i])) {
                            $newRange[] = $i;
                        }
                    }
                    $candidates[$field] = $newRange;
                }
            }

            foreach ($candidates as $field => $range) {
                if (count($range) === 1) {
                    $fixed[$field] = $range[0];
                    unset($candidates[$field]);
                }
            }

            foreach ($fixed as $field => $position) {
                foreach ($candidates as $candidateField => $range) {
                    $candidates[$candidateField] = array_filter($range, fn(int $pos): bool => $pos !== $position);
                }
            }
        }

        $answer = 1;

        foreach ($fields as $i => $field) {
            if (str_starts_with($field['field'], 'departure')) {
                $answer *= $own[$fixed[$i]];
            }
        }

        return $answer;
    }
}