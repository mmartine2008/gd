<?php
require_once('Point2D.php');
require_once('Camino.php');

class Poligono extends Camino {

    function __construct($canvas, $puntos) {
        $puntos[] = $puntos[0];
        parent::__construct($canvas, $puntos);
    }

    
}