<?php
declare(strict_types=1);

require_once __DIR__.'/../src/gilded_rose.php';

use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase {

    function testFoo() {
        $items = array(new Item("foo", 2, 5));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals("foo", $items[0]->name);
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(4, $items[0]->quality);
    }

    // - Once the sell by date has passed, Quality degrades twice as fast
    function testOnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(){
        $items = array(new Item("foo", 2, 5));

        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();
        $this->assertEquals(4, $items[0]->quality);

        $gildedRose->update_quality();
        $this->assertEquals(3, $items[0]->quality);

        $gildedRose->update_quality();
        $this->assertEquals(1, $items[0]->quality);
    }

}
