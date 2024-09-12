<?php

require_once('Point2D.php');

class Poligono {
    protected $canvas;
    protected $puntos = [];
    protected $color;

    function __construct($canvas, $puntos) {
        $this->canvas = $canvas;
        $this->puntos = $puntos;

        $this->color = $this->canvas->createColor(0, 0, 0);
    }

    function setColor($color) {
        $this->color = $color;
    }   

    function draw() {

        $origen = $this->puntos[0];
        $this->canvas->move($origen);

        for ($i = 1; $i <count($this->puntos); $i++) {
            $destino = $this->puntos[$i];
            $this->canvas->move($origen);
            $this->canvas->line($destino, $this->color);
            $origen = $destino;
        }
        $this->canvas->line($this->puntos[0], $this->color);

    }
    
}