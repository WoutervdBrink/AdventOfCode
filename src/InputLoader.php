<?php


namespace Knevelina\AdventOfCode;


use JetBrains\PhpStorm\Pure;
use RuntimeException;

class InputLoader
{
    public static function getInput(int $year, $day): string
    {
        if (!file_exists($path = self::getInputPath($year, $day))) {
            throw new RuntimeException(sprintf('Input for day %d does not exist!', $day));
        }

        return file_get_contents($path);
    }

    #[Pure] private static function getInputPath(int $year, int $day): string
    {
        return sprintf('%s/../resources/inputs/%d/day%02d.txt', __DIR__, $year, $day);
    }

    public static function getExample(int $year, $day, int $example): string
    {
        if (!file_exists($path = self::getExamplePath($year, $day, $example))) {
            throw new RuntimeException(sprintf('Input for example %d of day %d does not exist!', $day, $example));
        }

        return file_get_contents($path);
    }

    #[Pure] private static function getExamplePath(int $year, $day, int $example): string
    {
        return sprintf('%s/../resources/examples/%d/%02d/example%d.txt', __DIR__, $year, $day, $example);
    }
}