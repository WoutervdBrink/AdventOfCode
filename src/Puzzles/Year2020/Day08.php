<?php


namespace Knevelina\AdventOfCode\Puzzles\Year2020;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\CPU;
use Knevelina\AdventOfCode\Data\Year2020\Instruction;
use Knevelina\AdventOfCode\Data\Year2020\Operation;
use Knevelina\AdventOfCode\Data\Year2020\Program;

class Day08 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        $program = Program::fromSpecification($input);
        $cpu = new CPU($program);

        $cpu->terminates();

        return $cpu->getAccumulator();
    }

    public function part2(string $input): int
    {
        $program = Program::fromSpecification($input);

        for ($add = 0; $add < $program->getSize(); $add++) {
            $ins = $program->getInstruction($add);

            if ($ins->getOperation() !== Operation::JMP && $ins->getOperation() !== Operation::NOP) {
                continue;
            }

            $clone = $program->clone();

            $clone->setInstruction($add, new Instruction(
                match ($ins->getOperation()) {
                    Operation::JMP => Operation::NOP,
                    Operation::NOP => Operation::JMP,
                    default => Operation::EOF
                },
                $ins->getArgument()
            ));

            $cpu = new CPU($clone);

            if ($cpu->terminates()) {
                return $cpu->getAccumulator();
            }
        }

        return 0;
    }
}