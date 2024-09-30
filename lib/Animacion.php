<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Cuadrado.php');
    require_once('lib/Point2D.php');

    class Animacion {
        protected $frames = [];
        protected $canva;

        function __construct($w, $h, $cartesian = true) {
            $this->w = $w;
            $this->h = $h;
            $this->cartesian = $cartesian;

            $this->initCanva();
        }

        function initCanva() {
            $this->canva = new Canva($this->w, $this->h);

            if ($this->cartesian) {
                $this->canva->addCartesian();
            }
        }

        function getCanva() {
            return $this->canva;
        }

        function addFrame($reiniciar = false) {
            $c = count($this->frames);
            $name = "file_$c.png";
            $this->canva->draw($name);            

            $this->frames[] = $name;

            if ($reiniciar) {
                $this->initCanva();
            }
        }

        function make($fileName) {
            // Combinar las imágenes en un GIF animado usando ImageMagick
            exec("convert -delay 1 " . implode(' ', $this->frames) . " ".$fileName);

            // Eliminar los archivos temporales
            foreach ($this->frames as $file) {
                unlink($file);
            }
        }
    
    }

