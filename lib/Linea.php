<?php
    require_once('Point2D.php');
    require_once('Circulo.php');

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

        function draw($color = null) {
            if ($color) {
                $this->color = $color;
            }

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
                return INF;
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
            if ($this->esVertical()) {
                return $this->intersectaVertical($otra);
            } else {
                return $this->intersectaGeneral($otra);
            }
        }

        /**
         * Return true cuando $this no es vertival y se intersecta con $otra
         */
        function intersectaGeneral($otra) {
            if  ($this->esHorizontal() && $otra->esHorizontal()) {
                
                return $this->intersectaHorizontales($otra);
            }

            if  ($this->esHorizontal() && $otra->esVertical()) {
                $this->color = $this->canvas->createColor(255, 0, 0);
                $this->draw($this->canvas->createColor(0, 255, 0));
                $otra->draw($this->canvas->createColor(0, 0, 255));
                return $this->intersecHorizontalVertical($otra);
            }
            
            $this->draw();

            $a1 = $this->pendiente();
            $a2 = $otra->pendiente();
            $b1 = $this->ordenadaOrigen();
            $b2 = $otra->ordenadaOrigen();
            
            $x = ($b2 -$b1) / ($a1 - $a2);
            $y = $a1 * $x +$b1;

            $intersec = $this->perteneceSegmento($x, $y) && 
                        $otra->perteneceSegmento($x, $y);

            if ($intersec) {
                $c = new Circulo($this->canvas, new Point2D($x, $y), 10);
                $c->draw($this->canvas->createColor(255, 0, 0));
            }

            return $intersec;

        }

        /**
         * Return true cuando $this es vertival y se intersecta con $otra
         */
        function intersectaVertical($otra) {
            if ($otra->esVertical()) {
                if ($this->origen->getX() == $otra->getOrigen()->getX()) {
                    $intersect = $this->perteneceImagen($otra->getOrigen()->getY()) ||
                    $this->perteneceImagen($otra->getDestino()->getY());    
                    
                    return $intersect;
                }
            }

            if ($otra->esHorizontal()) {
                $intersect = $otra->perteneceDominio(
                    $this->origen->getX()
                ) && ($this->perteneceImagen($otra->getOrigen()->getY()));

                if ($intersect ) {
                    $x = $this->origen->getX();
                    $y = $otra->getOrigen()->getY();
                    $c = new Circulo($this->canvas, new Point2D($x, $y), 10);
//                    $c->draw($this->canvas->createColor(0, 0, 255));
                    $c->draw();
                
//                    $otra->draw($this->canvas->createColor(0, 0, 255));
//                    $this->draw($this->canvas->createColor(0, 0, 255));
                }

                return $intersect;
            }

            $a = $otra->pendiente();
            $b = $otra->ordenadaOrigen();
            $x = $this->origen->getX();
            $y = $a * $x + $b;

            $intersect = $otra->perteneceSegmento($x, $y);
            if ($intersect ) {
                $c = new Circulo($this->canvas, new Point2D($x, $y), 10);
                $c->draw();
            }

            return $intersect;

        }

        // true: si $inicio <= $valor <= $fin
        function perteneceLimites($inicio, $fin, $valor) {
            if ($inicio < $valor) {
                return ($inicio <= $valor) && ($valor <= $fin);
            } else {
                return ($fin <= $valor) && ($valor <= $inicio);
            }
        }

        function perteneceDominio($x) {
            return $this->perteneceLimites($this->origen->getX(), $this->destino->getX(), $x);
        }

        function perteneceImagen($y) {
            return $this->perteneceLimites($this->origen->getY(), $this->destino->getY(), $y);
        }

        function perteneceSegmento($x, $y) {
            return $this->perteneceDominio($x) && 
                    $this->perteneceImagen($y);
        }

        function pertenecePunto($x0, $y0) {
            if ($this->esVertical()) {
                return ($this->origen->getX() == $x0) && 
                    ($this->perteneceImagen($y0));
            }

            $a = $this->pendiente();
            $b = $this->ordenada();
            
            if ($y0 == $a * $x0 + $b) {
                return $this->perteneceSegmento($x0, $y0);
            }
            return false;
        }

        /**
         * Get the value of origen
         */ 
        public function getOrigen()
        {
                return $this->origen;
        }

        public function getDestino()
        {
                return $this->destino;
        }

        public function intersectaHorizontales($otra) {
            return 
                $this->origen->getY() == $otra->getOrigen()->getY() && 
                ($this->perteneceDominio($otra->getOrigen()->getX()) 
                    || $this->perteneceDominio($otra->getDestino()->getX()));
        } 

        public function intersecHorizontalVertical($otra) {
            $x = $otra->getOrigen()->getX();
            $y = $this->getOrigen()->getY();

            $intersec = $this->perteneceDominio($x) && 
                         $otra->perteneceImagen($y);
                         
            if ($intersec) {
                $c = new Circulo($this->canvas, new Point2D($x, $y), 10);
                $c->draw($this->canvas->createColor(255, 0, 0));
            }           

            return $intersec;
        }


        function desplazar($deltaX, $deltaY) {

            $this->getOrigen()->desplazar($deltaX, $deltaY);
            $this->getDestino()->desplazar($deltaX, $deltaY);
            

        }  
        
        function rotar($alpha) {
            $this->getOrigen()->rotar($alpha);
            $this->getDestino()->rotar($alpha);
        }
    }