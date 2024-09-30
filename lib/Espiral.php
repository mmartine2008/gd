<?php
require_once('Point2D.php');
require_once('Poligono.php');

class Espiral {

    protected $centro;
    protected $inicio;
    protected $fin;
    protected $canva;

    function __construct($canva, $centro, $inicio, $fin) {
        $this->canva = $canva;
        $this->centro = $centro;
        $this->inicio = $inicio;
        $this->fin = $fin;        
    }

    function draw() {
        $black = $this->canva->createColor(0, 0, 0);

        $x = $this->inicio * cos(0) + $this->centro->getX();
        $y = $this->inicio * sin(0) + $this->centro->getY();
        $rho = $this->inicio;
        $deltaAlpha = 0.01;
        $n = 2 * pi() / $deltaAlpha;
        $deltaRho = ($this->fin - $this->inicio) / $n;

        $this->canva->moveTo($x, $y);
        for ($alpha = 0; $alpha <= 2 * pi(); $alpha = $alpha +$deltaAlpha) {
            
//            $rho = ($this->fin - $this->inicio) * $alpha / 2 * pi() + $this->inicio; 
            $rho = $rho + ($this->fin - $this->inicio) / $n; 
            
            $x = $rho * cos($alpha) + $this->centro->getX();
            $y = $rho * sin($alpha) + $this->centro->getY();
            
            $this->canva->lineTo($x, $y, $black);

        }
        
    }
    
}