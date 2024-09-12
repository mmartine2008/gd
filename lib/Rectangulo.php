<?php
    require_once('Point2D.php');

    class Rectangulo {
        protected $canvas;
        protected $origen;
        protected $width;
        protected $height;

        function __construct($canvas, Point2D $origen, $width, $height) {
            $this->canvas = $canvas;
            $this->origen = $origen;
            $this->width = $width;
            $this->height = $height;

            $this->color = $this->canvas->createColor(0, 0, 0);
        }

        function setColor($color) {
            $this->color = $color;
        }

        function draw() {
            $x = $this->origen->getX();
            $y = $this->origen->getY();
            try {
                $this->canvas->move($this->origen);
                $this->canvas->line(new Point2D($x+$this->width, $y), $this->color);
                $this->canvas->line(new Point2D($x+$this->width, $y+$this->height), $this->color);
                $this->canvas->line(new Point2D($x, $y+$this->height), $this->color);
                $this->canvas->line($this->origen, $this->color);
            } catch (\Throwable $th) {
                echo ($th);
                die;
            }

        }

        

    }