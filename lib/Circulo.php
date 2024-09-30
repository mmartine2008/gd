<?php
require_once('Point2D.php');
require_once('Poligono.php');

class Circulo {

    protected $centro;
    protected $radio;
    protected $canva;

    function __construct($canva, $centro, $radio) {
        $this->canva = $canva;
        $this->centro = $centro;
        $this->radio = $radio;
    }

    function draw() {
        $black = $this->canva->createColor(0, 0, 0);

        $x = $this->radio * cos(0) + $this->centro->getX();
        $y = $this->radio * sin(0) + $this->centro->getY();

        $this->canva->moveTo($x, $y);
        for ($alpha = 0; $alpha <= 2 * pi(); $alpha = $alpha +0.01) {
            $x = $this->radio * cos($alpha) + $this->centro->getX();
            $y = $this->radio * sin($alpha) + $this->centro->getY();
            
            $this->canva->lineTo($x, $y, $black);

        }
        
    }
    
}