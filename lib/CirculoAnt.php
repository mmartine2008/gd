<?php
require_once('Point2D.php');
require_once('Poligono.php');

class CirculoAnt {

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

        $this->canva->moveTo(-$this->radio, $this->centro->getY());
        for($x = -$this->radio; $x <= $this->radio; $x = $x +1) {
            $y = sqrt($this->radio*$this->radio - $x*$x);
            $this->canva->lineTo($x, $y, $black);
        }

        $this->canva->moveTo(-$this->radio, $this->centro->getY());
        for($x = -$this->radio; $x <= $this->radio; $x = $x +1) {
            $y = -sqrt($this->radio*$this->radio - $x*$x);
            $this->canva->lineTo($x, $y, $black);
        }
        
    }
    
}