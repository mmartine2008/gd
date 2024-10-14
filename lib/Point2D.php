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
    }