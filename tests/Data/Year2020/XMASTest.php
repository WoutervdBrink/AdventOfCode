<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\XMAS;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\XMAS
 */
class XMASTest extends TestCase
{
    /** @test */
    function it_takes_a_preamble(): void
    {
        $xmas = new XMAS(3);

        $this->assertTrue($xmas->push(1));
        $this->assertTrue($xmas->push(2));
        $this->assertTrue($xmas->push(5));
    }

    /** @test */
    function it_rejects_invalid_numbers(): void
    {
        $xmas = new XMAS(5);

        foreach ([35, 20, 15, 25, 47, 40, 62, 55, 65, 95, 102, 117, 150, 182] as $number) {
            $this->assertTrue($xmas->isValid($number));
            $this->assertTrue($xmas->push($number));
        }

        $this->assertFalse($xmas->isValid(127));
        $this->assertFalse($xmas->push(127));
    }
}
