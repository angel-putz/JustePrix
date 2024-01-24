<?php

class Objet {
    public $image;
    public $price;

    public function __construct($image, $price) { // on peut mettre des valeurs ou rien du tout pour les paramètres
        $this->image = $image;
        $this->price = $price;
    }

    public function display() { // permet d'afficher l'image de l'objet 
        echo '<img src="' . $this->image . '" alt="Item image" style ="width: 400px; height: 400px;">';
    }

}
