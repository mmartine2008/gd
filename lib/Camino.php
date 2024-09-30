<?php
require_once('lib/Linea.php');
require_once('Point2D.php');

class Camino {
    protected $canvas;
    protected $puntos = [];
    protected $color;
    protected $lineas = [];

    function __construct($canvas, $puntos) {
        $this->canvas = $canvas;
        $this->puntos = $puntos;

        $this->color = $this->canvas->createColor(0, 0, 0);
        $this->addLineas();
    }

    function setColor($color) {
        $this->color = $color;
    }   

    function addLineas() {
        $origen = $this->puntos[0];

        for ($i = 1; $i <count($this->puntos); $i++) {
            $destino = $this->puntos[$i];

            $l = new Linea($this->canvas, $origen, $destino);
            $this->lineas[] = $l;

            $origen = $destino;
        }

    }

    function draw() {

        foreach($this->lineas as $linea) {
            $linea->draw();
        }
    }
    
}