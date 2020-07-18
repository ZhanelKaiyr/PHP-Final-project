<?php
class main
{
    public $name;
    public $price;
    public $Ingredients;

    public function __construct($name,$price, $Ingredients)
    {
        $this->$name = $name;
        $this->$price = $price;
        $this->$Ingredients = $Ingredients;
        echo '<h1>'.$name.'</h1>';
        echo '<br>';
        echo '<p>Ingredients that contain dish:'.$Ingredients. '</p>';
        echo '<br>';
        echo '<p>Price:'.$price.'</p>';
        echo '<br>';
    }

}
?>