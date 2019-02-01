<?php
declare(strict_types=1);

require_once __DIR__.'/../src/gilded_rose.php';

use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase {

    function testFoo() {
        $items = array(new Item("foo", 0, 0));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals("foo", $items[0]->name);
    }

}
