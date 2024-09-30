<?php
    require_once('Point2D.php');
    require_once('Rectangulo.php');

    class Cuadrado extends Rectangulo {

        function __construct($canvas, Point2D $origen, $size) {
            parent::__construct($canvas, $origen, $size, $size);
        }
        

    }