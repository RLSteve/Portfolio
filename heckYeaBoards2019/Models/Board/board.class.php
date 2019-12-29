<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/19/2019
 * File: board.class.php
 * Description:
 */

class Board
{
    //brand, production_date, price, length, width, wood_type, image.

    private $id, $brand, $production_date, $length, $width, $wood_type, $image, $price;

    public function __construct($brand, $production_date, $length, $width, $wood_type, $image, $price)
    {
        $this->brand=$brand;
        $this->production_date=$production_date;
        $this->length=$length;
        $this->width=$width;
        $this->wood_type=$wood_type;
        $this->image=$image;
        $this->price=$price;
    }

    //get the id of a board
    public function getId()
    {
        return $this->id;
    }
    public function getBrand() {
        return $this->brand;
    }
    public function getProductionDate() {
        return $this->production_date;
    }

    public function getLength() {
        return $this->length;
    }
    public function getWidth() {
        return $this->width;
    }
    public function getWoodType() {
        return $this->wood_type;
    }
    public function getImage(){
        return $this->image;
    }
    public function getPrice(){
        return $this->price;
    }
    public function setID($id){
        $this->id = $id;

    }
}