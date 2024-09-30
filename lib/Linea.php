<?php
    require_once('Point2D.php');

    class Linea {
        protected $canvas;
        protected $origen;
        protected $destino;

        protected $color;

        function __construct($canvas, Point2D $origen, Point2D $destino) {
            $this->canvas = $canvas;
            $this->origen = $origen;
            $this->destino = $destino;
            $this->color = $this->canvas->createColor(0, 0, 0);
        }

        function setColor($color) {
            $this->color = $color;
        }

        function draw() {

            try {
                $this->canvas->move($this->origen);
                $this->canvas->line($this->destino, $this->color);
            } catch (\Throwable $th) {
                echo ($th);
                die;
            }

        }

        function esVertical() {
            $x0 = $this->origen->getX();
            $x1 = $this->destino->getX();

            return ($x0 == $x1);
        }

        function esHorizontal() {
            $y0 = $this->origen->getY();
            $y1 = $this->destino->getY();

            return ($y0 == $y1);
        }        

        /**
            y0 = a * x0 + b
         -
            y1 = a * x1 + b
            ---------------
            y0 - y1 = a * x0 - a * x1

            y0 - y1 = a * (x0 - x1)

            y0 - y1  = a 
            (x0 - x1)
         */
        function pendiente() {
            $y0 = $this->origen->getY();
            $y1 = $this->destino->getY();
            $x0 = $this->origen->getX();
            $x1 = $this->destino->getX();

            if ($x0 != $x1) {
                return ($y0 - $y1) / ($x0 - $x1);
            } else {
                return int::INF;
            }
            
        }

        /**
            y0 = a * x0 + b
            b = a * x0 - y0
         */
        function ordenadaOrigen() {
            $a = $this->pendiente();
            $x0 = $this->origen->getX();
            $y0 = $this->origen->getY();

            $b = $y0 - $a * $x0;

            return $b;
        }

        /**
            $this:            
            y = a1 * x +b1
            $otra:
            y = a2 * x +b2

            y = a1 * x +b1
            y = a2 * x +b2

            a1 * x +b1 = a2 * x +b2
            a1 * x - a2 * x = +b2 -b1
            (a1 - a2) * x = +b2 -b1
             x = (+b2 -b1) / (a1 - a2)

         */
        function intersecta($otra) {

            $a1 = $this->pendiente();
            $a2 = $otra->pendiente();
            $b1 = $this->ordenadaOrigen();
            $b2 = $otra->ordenadaOrigen();

            $x = ($b2 -$b1) / ($a1 - $a2);
            $y = $a1 * $x +$b1;

            return 
                $this->perteneceLimites($this->origen->getX(), $this->destino->getX(), $x) 
                &&
                $this->perteneceLimites($this->origen->getY(), $this->destino->getY(), $y) 
                ;

        }
        
        // true: si $inicio <= $valor <= $fin
        function perteneceLimites($inicio, $fin, $valor) {
            if ($inicio < $valor) {
                return ($inicio <= $valor) && ($valor <= $fin);
            } else {
                return ($fin <= $valor) && ($valor <= $inicio);
            }
        }
    }