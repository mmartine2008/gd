<?php
require_once('Point2D.php');
require_once('Poligono.php');

class Elipse {

    protected $centro;
    protected $ladoA;
    protected $ladoB;
    protected $canva;

    function __construct($canva, $centro, $ladoA, $ladoB) {
        $this->canva = $canva;
        $this->centro = $centro;
        $this->ladoA = $ladoA;
        $this->ladoB = $ladoB;
    }

    private function getR($alpha) {
        $cuerpo = pow(cos($alpha), 2) / pow($this->ladoA, 2) +
        pow(sin($alpha), 2) / pow($this->ladoB, 2);
       $r = 1/ sqrt($cuerpo);  

       return $r;
    } 

    function draw() {
        $black = $this->canva->createColor(0, 0, 0);

        $r = $this->getR(0);
        $x = $r * cos(0) + $this->centro->getX();
        $y = $r * sin(0) + $this->centro->getY();

        $this->canva->moveTo($x, $y);
        for ($alpha = 0; $alpha <= 2 * pi(); $alpha = $alpha +0.01) {

            $r = $this->getR($alpha);

            $x = $r * cos($alpha) + $this->centro->getX();
            $y = $r * sin($alpha) + $this->centro->getY();
            
            $this->canva->lineTo($x, $y, $black);

        }
        
    }
    
}