<?php
require_once('Point2D.php');
require_once('Poligono.php');

class Triangulo extends Poligono {

    function __construct($canvas, $p0, $p1, $p2) {
        parent::__construct($canvas, [$p0, $p1, $p2]);
    }
    
}