<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2015;

use Knevelina\AdventOfCode\Data\Year2015\Wire;
use Knevelina\AdventOfCode\Data\Year2015\WireCollection;
use Knevelina\AdventOfCode\Data\Year2015\WireOperator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2015\WireCollection
 */
class WireCollectionTest extends TestCase
{
    /** @test */
    function it_gets_wire_values()
    {
        $wc = new WireCollection(
            '123 -> x
456 -> y
x AND y -> d
x OR y -> e
x LSHIFT 2 -> f
y RSHIFT 2 -> g
NOT x -> h
NOT y -> i'
        );

        $this->assertEquals(72, $wc->getValue('d'));
        $this->assertEquals(507, $wc->getValue('e'));
        $this->assertEquals(492, $wc->getValue('f'));
        $this->assertEquals(114, $wc->getValue('g'));
        $this->assertEquals(65412, $wc->getValue('h'));
        $this->assertEquals(65079, $wc->getValue('i'));
        $this->assertEquals(123, $wc->getValue('x'));
        $this->assertEquals(456, $wc->getValue('y'));
    }

    /** @test */
    function it_rejects_invalid_gates(): void
    {
        $this->expectExceptionMessage('Invalid gate specification');

        new WireCollection('abc');
    }

    /** @test */
    function it_rejects_double_wires(): void
    {
        $this->expectExceptionMessage('Trying to add existing');

        new WireCollection("123 -> y\n456 -> y");
    }

    /** @test */
    function it_rejects_non_existent_wires(): void
    {
        $wc = new WireCollection('123 -> y');

        $this->expectExceptionMessage('Trying to get the value of non-existent wire');

        $wc->getValue('x');
    }

    /** @test */
    function it_gets_wires(): void
    {
        $wc = new WireCollection("123 -> y\nNOT y -> x");

        $this->assertEquals(
            [
                'y' => new Wire(WireOperator::VALUE, [123]),
                'x' => new Wire(WireOperator::NOT, ['y'])
            ],
            $wc->getWires()
        );
    }

    /** @test */
    function it_removes_wires(): void
    {
        $wc = new WireCollection("123 -> y\nNOT y -> x");

        $wc->removeWire('y');

        $this->assertEquals(['x' => new Wire(WireOperator::NOT, ['y'])], $wc->getWires());
    }
}