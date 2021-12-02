<?php
Class Item{
    public $id;
    public $title;
    public $price;
    public $image;

    function __construct($id, $title, $price, $image){
        $this->id=$id;
        $this->title = $title;
        $this->price=$price;
        $this->image=$image;
    }
}
