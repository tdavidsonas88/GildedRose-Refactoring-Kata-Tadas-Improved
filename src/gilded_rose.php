<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            if ($item->name != 'Aged Brie' and 
                $item->name != 'Backstage passes to a TAFKAL80ETC concert' 
                ) {
                // The Quality of an item is never negative
                if ($item->quality > 0) {
                    // "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                    // 	- "Conjured" items degrade in Quality twice as fast as normal items
                    if($item->name == 'Conjured Mana Cake'){
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                // The Quality of an item is never more than 50
                if ($item->quality < 50) {
                    // "Aged Brie" actually increases in Quality the older it gets
                    // "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
                    $item->quality = $item->quality + 1;

                    //Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        // and by 3 when there are 5 days
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }
            
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                // "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
                $item->sell_in = $item->sell_in - 1;
            }
            // Once the sell by date has passed, Quality degrades twice as fast
            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            // "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                // Once the sell by date has passed, Quality degrades twice as fast
                                $item->quality = $item->quality - 1;
                            }
                        }
                    // Quality drops to 0 after the concert
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } 
                //  'Aged Brie' increases by Two in quality after sell_in finished
                else {
                    // The Quality of an item is never more than 50
                    if ($item->quality < 50) {
                        // "Aged Brie" actually increases in Quality the older it gets
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}

class Item {

    public $name;   
    public $sell_in; // denotes the number of days we have to sell the item
    public $quality; // denotes how valuable the item is

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

