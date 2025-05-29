<?php
require_once('Point2D.php');
require_once('Camino.php');
require_once('Rectangulo.php');

class Poligono extends Camino {

    function __construct($canvas, $puntos) {

        $this->puntos[] = $puntos[0];
        parent::__construct($canvas, $puntos);
    }

    
}