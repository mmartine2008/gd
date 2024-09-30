<?php
    require_once('lib/Point2D.php');
    require_once('lib/Poligono.php');
    class Rectangulo extends Poligono {

        function __construct($canvas, Point2D $origen, $width, $height) {
            $puntos = [];
            $puntos[] = $origen;
            $puntos[] = new Point2D($origen->getX() +$width, $origen->getY());
            $puntos[] = new Point2D($origen->getX() +$width, $origen->getY() +$height);
            $puntos[] = new Point2D($origen->getX(), $origen->getY() +$height);
            parent::__construct($canvas, $puntos);
        }

        

    }