<?php


namespace Knevelina\AdventOfCode\Tests\Data\Year2015;


use Knevelina\AdventOfCode\Data\Year2015\WireCollection;
use PHPUnit\Framework\TestCase;

class WireCollectionTest extends TestCase
{
    /** @test */
    function it_gets_wire_values()
    {
        $wc = new WireCollection('123 -> x
456 -> y
x AND y -> d
x OR y -> e
x LSHIFT 2 -> f
y RSHIFT 2 -> g
NOT x -> h
NOT y -> i');

        $this->assertEquals(72, $wc->getValue('d'));
        $this->assertEquals(507, $wc->getValue('e'));
        $this->assertEquals(492, $wc->getValue('f'));
        $this->assertEquals(114, $wc->getValue('g'));
        $this->assertEquals(65412, $wc->getValue('h'));
        $this->assertEquals(65079, $wc->getValue('i'));
        $this->assertEquals(123, $wc->getValue('x'));
        $this->assertEquals(456, $wc->getValue('y'));
    }
}