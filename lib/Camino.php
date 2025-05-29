<?php
require_once('lib/Linea.php');
require_once('lib/Circulo.php');
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

    function getLineas() {
        return $this->lineas;
    }

    function draw($color = null) {

        foreach($this->lineas as $linea) {
            $linea->draw($color);
        }
    }

    function intersecta($otro) {
        foreach ($this->lineas as $estaLinea) {
            foreach ($otro->getLineas() as $otraLinea) {
                if ($estaLinea->intersecta($otraLinea)) {
//                    return true;
                }
            }
        }
        return false;
    }

    function desplazar($deltaX, $deltaY) {
        foreach ($this->lineas as $linea) {
            $linea->desplazar($deltaX, $deltaY);
        }
    }

    function rotar($alpha) {
        foreach ($this->lineas as $linea) {
            $linea->rotar($alpha);
        }
    }

    function centroGeometrico() {

        $cantidad = count($this->puntos);

        $p0 = $this->puntos[0];
        $pUltimo = $this->puntos[$cantidad -1];

        if ($p0->igual($pUltimo)) {
            $cantidad = $cantidad -1;
        }

        $acumX = (float) 0;
        $acumY = (float) 0;
        
        for($i = 0; $i < $cantidad; $i++) {
            $p = $this->puntos[$i];

            $acumX += $p->getX();
            $acumY += $p->getY();
           
        }
        $promX = $acumX / $cantidad;
        $promY = $acumY / $cantidad;
        
        $centro = new Point2D($promX, $promY);

        $rojo = $this->canvas->createColor(255, 0, 0);
        $this->canvas->moveTo($promX, $promY-10, $rojo);
        $this->canvas->lineTo($promX, $promY+10, $rojo);
        $this->canvas->moveTo($promX-10, $promY, $rojo);
        $this->canvas->lineTo($promX+10, $promY, $rojo);

 //       $c = new Circulo($this->canvas, $centro, 10);
 //       $c->draw($this->canvas->createColor(255, 0, 0));

        return $centro;
    }

    function autoRotar($alpha) {
        $centro = $this->centroGeometrico();
        $this->desplazar(-$centro->getX()/2, -$centro->getY()/2);
        $this->rotar($alpha);
        $this->desplazar($centro->getX()/2, $centro->getY()/2);
        $this->draw();
    }
    
}