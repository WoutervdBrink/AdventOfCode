<?php

function append_zero(int $x): string {
    return $x < 10 ? '0'.$x : $x;
}

if ($argc < 2) {
    echo 'Usage: php '.$argv[0].' <day> [part]'.PHP_EOL;
    exit(1);
}

$day = append_zero(intval($argv[1]));
$part = intval($argv[2] ?? 0);
$part = append_zero(max(0, min(2, $part)));

$file = sprintf('%s/puzzles/day%s.php', __DIR__, $day);
$input1 = sprintf('%s/input/day%spart01', __DIR__, $day);
$input2 = sprintf('%s/input/day%spart02', __DIR__, $day);
$template = sprintf('%s/solution.php', __DIR__);

if (!file_exists($file)) {
    echo 'The puzzle solution does not exist yet!'.PHP_EOL;
    echo 'I will create one for you.'.PHP_EOL;
    file_put_contents($file, file_get_contents($template));
    exit(1);
}

/** @noinspection PhpIncludeInspection */
require_once $file;

switch ($part) {
    case 0:
        echo part1(file_get_contents($input1));
        echo part2(file_get_contents($input2));
        break;
    case 1:
        echo part1(file_get_contents($input1));
        break;
    case 2:
        echo part2(file_get_contents($input2));
        break;
}