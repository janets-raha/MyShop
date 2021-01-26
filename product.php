<?php 

class Product {

    public $name;
    public $description;
    public $image;
    public $price;
    public $category_id;

    public function __construct($name, $description, $image, $price) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_image($image) {
        $this->image = $image;
    }

    public function get_image() {
        return $this->image;
    }

    public function set_price($price) {
        $this->price = $price;
    }

    public function get_price() {
        return $this->price;
    }

    public function get_category_id() {
        return $this->category_id;
    }


} 

?>
