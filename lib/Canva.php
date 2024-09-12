<?php
    require_once('Point2D.php');

    class Canva {

        private $gd;
        private $fontSize;
        private $fontName;
        private $fontColor;
        private $width;
        private $height;

        private $actualPoint2D;

        function __construct($w, $h) {
            $this->height = $h;
            $this->width = $w;
            $this->gd = imagecreatetruecolor($w, $h);
            $this->fontSize = 12;
            $this->fontName = 'fonts/arial.ttf';
            $this->fontColor = imagecolorallocate($this->gd, 0, 0, 0);

            $this->actualPoint2D = new Point2D(0, 0);
        }

        function addCartesian() {
            $white = $this->createColor(255, 255, 255);
        
            $this->setBackground($white);
            $this->texto(5, 20, "(0, 0)");
            $this->texto(580, 20, "(640, 0)");
            $this->texto(5, 460, "(0, 480)");
            $this->texto(560, 460, "(640, 480)");

        }

        function createColor($r, $g, $b) {
            $color = imagecolorallocate($this->gd, $r, $g, $b);
            return $color;
        }

        function setBackground($color) {
            imagefill($this->gd, 0, 0, $color);
        }

        function texto($x, $y, $label)
        {
            imagettftext($this->gd, $this->fontSize, 0, 
                    $this->tx($x), $this->ty($y), 
                    $this->fontColor, $this->fontName, $label);
        }

        function draw($file) {
            header("Content-type: image/png");
            imagepng($this->gd, $file);
        }

        function tx($x) {
            return $x + ($this->width/2);
        }

        function ty($y) {
            return ($this->height/2) -$y;
        }

        // Pone un punto con traslacion
        function setPoint($x, $y, $color) {

            imagesetpixel($this->gd, $this->tx($x), $this->ty($y), $color);
        }

        function moveTo($x, $y) {
            $this->actualPoint2D = new Point2D($x, $y);
        }

        function move(Point2D $xy) {
            $this->actualPoint2D = $xy;
        }

        function line(Point2D $xy, $color) {
            $this->lineTo($xy->getX(), $xy->getY(), $color);
        }

        function lineTo($x, $y, $color) {
            
            imageline(
                $this->gd,
                $this->tx($this->actualPoint2D->getX()), 
                $this->ty($this->actualPoint2D->getY()),
                $this->tx($x), 
                $this->ty($y),
                $color);
                $this->moveTo($x, $y);
        }
    }