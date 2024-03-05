<?php
class Item {
    public $name;
    public $amount;
    public $quantity;

    public function __construct($name, $amount,$quantity) {
        $this->name = $name;
        $this->amount = $amount;
        $this->quantity = $quantity;
    }
}
