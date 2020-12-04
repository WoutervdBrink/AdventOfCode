<?php


namespace Knevelina\AdventOfCode;


class InputLoader
{
    private static function getInputPath(int $day): string
    {
        return sprintf('%s/../resources/inputs/day%02d.txt', __DIR__, $day);
    }

    private static function getExamplePath(int $day, int $example): string
    {
        return sprintf('%s/../resources/examples/day%02d_example%d.txt', __DIR__, $day, $example);
    }

    public static function getInput(int $day): string
    {
        if (!file_exists($path = self::getInputPath($day))) {
            throw new \RuntimeException(sprintf('Input for day %d does not exist!', $day));
        }

        return file_get_contents(self::getInputPath($day));
    }

    public static function getExample(int $day, int $example): string
    {
        if (!file_exists($path = self::getExamplePath($day, $example))) {
            throw new \RuntimeException(sprintf('Input for example %d of day %d does not exist!', $day, $example));
        }

        return file_get_contents(self::getExamplePath($day, $example));
    }
}