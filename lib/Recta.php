<?php
    require_once('Point2D.php');

    class Recta {
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

        

    }