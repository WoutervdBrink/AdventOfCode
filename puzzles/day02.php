<?php

function part1(string $input) {
    $specifications = explode("\n", $input);
    $valid = 0;

    foreach ($specifications as $specification) {
        $specification = trim($specification);
        if (strlen($specification) === 0) {
            continue;
        }
        preg_match('/^([0-9]+)-([0-9]+) ([a-z]): ([a-z]+)$/', $specification, $match);
        $amountFrom = $match[1];
        $amountTo = $match[2];
        $letter = $match[3];
        $password = $match[4];
        $count = 0;
        for ($i = 0; $i < strlen($password); $i++) {
            if (substr($password, $i, 1) === $letter) {
                $count++;
            }
        }
        if ($count >= $amountFrom && $count <= $amountTo) {
            $valid++;
        }
    }

    return $valid;
}

function part2(string $input) {
    $specifications = explode("\n", $input);
    $valid = 0;

    foreach ($specifications as $specification) {
        preg_match('/^([0-9]+)-([0-9]+) ([a-z]): ([a-z]+)$/', $specification, $match);
        $pos1 = $match[1];
        $pos2 = $match[2];
        $letter = $match[3];
        $password = $match[4];

        $has1 = substr($password, $pos1 - 1, 1) === $letter;
        $has2 = substr($password, $pos2 - 1, 1) === $letter;

        if ($has1 ^ $has2) {
            $valid++;
        }
    }

    return $valid;
}