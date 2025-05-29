<?php
require_once('Point2D.php');
require_once('Poligono.php');
require_once('Rectangulo.php');

class PolyLado extends Poligono {

    function generate($centro, $lados, $radio) {

        $inc = 2 * pi() / $lados;
        $tita = 0;
        
        $puntos = [];
        while ($tita < 2 * pi()) {
            $x = $radio * cos ($tita) + $centro->getX();
            $y = $radio * sin ($tita) + $centro->getY();
            
            $puntos[] = new Point2D($x, $y);
            $tita += $inc;
        }    

        $puntos[] = $puntos[0];
        return $puntos;
    }

    function __construct($canvas, $centro, $lados, $radio) {

        $puntos = $this->generate($centro, $lados, $radio);
        parent::__construct($canvas, $puntos);
    }

    
}