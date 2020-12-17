<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use JetBrains\PhpStorm\Pure;

/**
 * @property string|null $byr
 * @property string|null $iyr
 * @property string|null $eyr
 * @property string|null $hgt
 * @property string|null $hcl
 * @property string|null $ecl
 * @property string|null $pid
 * @property string|null $cid
 */
class Passport
{
    private array $data;

    /**
     * @param string $specification
     * @return Passport
     */
    public static function fromSpecification(string $specification): Passport
    {
        $specification = str_replace("\n", ' ', $specification);

        $specification = explode(' ', $specification);

        $passport = new Passport();

        foreach ($specification as $data) {
            $data = explode(':', trim($data), 2);
            $key = $data[0];
            $value = $data[1];
            $passport->{$key} = $value;
        }

        return $passport;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function __get(string $name): string|null
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, mixed $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (!$this->hasAllFields()) {
            return false;
        }

        $byr = intval($this->byr);
        if ($byr < 1920 || $byr > 2002) {
            return false;
        }

        $iyr = intval($this->iyr);
        if ($iyr < 2010 || $iyr > 2020) {
            return false;
        }

        $eyr = intval($this->eyr);
        if ($eyr < 2020 || $eyr > 2030) {
            return false;
        }

        if (preg_match('/^([0-9]+)(cm|in)$/', $this->hgt, $matches)) {
            $length = intval($matches[1]);
            $unit = $matches[2];

            if ($unit === 'cm' && ($length < 150 || $length > 193)) {
                return false;
            }
            if ($unit === 'in' && ($length < 59 || $length > 76)) {
                return false;
            }
        } else {
            return false;
        }

        if (!preg_match('/^#[0-9a-f]{6}$/', $this->hcl)) {
            return false;
        }
        if (!in_array($this->ecl, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
            return false;
        }
        if (!preg_match('/^[0-9]{9}$/', $this->pid)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    #[Pure] public function hasAllFields(): bool
    {
        foreach (['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'] as $key) {
            if (!$this->has($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $name
     * @return bool
     */
    #[Pure] public function has(string $name): bool
    {
        return isset($this->data[$name]) && !is_null($this->data[$name]);
    }
}