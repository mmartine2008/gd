<?php

    class Point2D {
        private $x;
        private $y;

        function __construct($x, $y) {
            $this->x = $x;
            $this->y = $y;

        }

        function getX() {
            return $this->x;
        }
        function getY() {
            return $this->y;
        }

        function desplazar($deltaX, $deltaY) {
            $this->x += $deltaX;
            $this->y += $deltaY;
        } 
        
        function rotar($alpha) {
            $x = $this->x;
            $y = $this->y;
            
            $this->x = $x * cos($alpha) - $y * sin($alpha);
            $this->y = $x * sin($alpha) + $y * cos($alpha);;
        }

        function igual($otro) {
            return ($this->x == $otro->getX()) && 
                    ($this->y == $otro->getY());

        }
    }