<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Ds\Vector;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day09 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = str_split($input);
        /** @var list<object{id: int, size: int}> $disk */
        $disk = [];
        $fileId = 0;
        for ($i = 0; $i < count($input); $i += 2) {
            $size = intval($input[$i]);
            $free = intval($input[$i + 1] ?? 0);

            $disk[] = (object) ['id' => $fileId++, 'size' => $size];
            if ($free > 0) {
                $disk[] = (object) ['id' => -1, 'size' => $free];
            }
        }

        $from = count($disk) - 1;
        $to = 0;

        while ($from > 0 && $to < $from) {
            if ($disk[$from]->id === -1) {
                $from--;

                continue;
            }

            if ($disk[$to]->id !== -1) {
                $to++;

                continue;
            }

            $needed = $disk[$from]->size;
            $available = min($disk[$to]->size, $needed);

            if ($needed === 0) {
                $from--;

                continue;
            }

            if ($available === 0) {
                $to++;

                continue;
            }

            $disk[$to]->size -= $available;
            $disk[$from]->size -= $available;
            array_splice($disk, $to, 0, [(object) ['id' => $disk[$from]->id, 'size' => $available]]);
            $to++;
            $from++;
        }

        $part1 = 0;
        $idx = 0;

        foreach ($disk as $file) {
            if ($file->id === -1) {
                continue;
            }

            for ($i = 0; $i < $file->size; $i++) {
                $part1 += $idx * $file->id;
                $idx++;
            }
        }

        return $part1;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = str_split($input);

        $disk = new Vector;
        $diskSize = array_sum($input);
        $disk->insert(0, ...array_fill(0, $diskSize, -1));

        $idx = 0;
        $fileId = 0;

        $inputSize = count($input);
        for ($b = 0; $b < $inputSize; $b += 2) {
            $size = intval($input[$b]);
            $free = intval($input[$b + 1] ?? 0);

            for ($i = 0; $i < $size; $i++) {
                $disk->set($idx++, $fileId);
            }

            $idx += $free;
            $fileId++;
        }

        //        echo implode('', array_map(fn (int $val): string => $val === -1 ? '.' : strval($val), $disk->toArray())) . PHP_EOL;

        for ($from = $diskSize - 1; $from > 0; $from--) {
            $fileId = $disk->get($from);

            if ($fileId === -1) {
                continue;
            }

            $size = 1;

            while (($from - $size > 0) && $disk->get((int) $from - $size) === $fileId) {
                $size++;
            }

            for ($to = 0; $to < ($from - $size); $to++) {
                for ($offset = 0; $offset < $size; $offset++) {
                    if ($disk->get($to + $offset) !== -1) {
                        $to += $offset;

                        continue 2;
                    }
                }

                for ($offset = 0; $offset < $size; $offset++) {
                    $disk->set($to + $offset, $fileId);
                    $disk->set((int) $from - $offset, -1);
                }

                break;
            }

            $from -= ($size - 1);
        }

        $part2 = 0;

        for ($idx = 0; $idx < $diskSize; $idx++) {
            $val = $disk->get($idx);

            if ($val !== -1) {
                $part2 += $idx * $val;
            }
        }

        return $part2;
    }
}
