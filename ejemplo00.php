<?php
    class Linea {
        private $gd;
        protected $x0, $y0, $x1, $y1;
        private $color;

        public function __construct($gd) {
            $this->gd = $gd;
            $this->color = imagecolorallocate($this->gd, 0, 0, 0); 
        }

        public function setOrigen($x0, $y0) {
            $this->x0 = $x0;
            $this->y0 = $y0;
        }

        public function setDestino($x1, $y1) {
            $this->x1 = $x1;
            $this->y1 = $y1;
        }

        private function proy($y) {
            return 240 - $y;
        }
        public function  draw() {
            $difx = 640 / 2;
            

            imageline($this->gd, 
                $this->x0 + $difx, $this->proy($this->y0), 
                $this->x1 + $difx, $this->proy($this->y1), 
                $this->color);

                imageline($this->gd, 
                0, 240, 
                640, 240, 
                $this->color);
                
   /*         print_r([$this->x0 + $difx, $this->proy($this->y0), 
            $this->x1 + $difx, $this->proy($this->y1)]);

            */
        }
    }

    function crearPizarra($width, $height) {
        $image = imagecreatetruecolor($width, $height);

        $white = imagecolorallocate($image, 255, 255, 255); // Blanco
        imagefill($image, 0, 0, $white);

        return $image;
    }
    

    function mostrarPizarra($image) {
        header("Content-type: image/png");
        imagepng($image);
    }

    $pizarra = crearPizarra(640, 480);

    $data = [
        [0, 0],
        [1, 1],
        [2, 4],
        [3, 9],
        [4, 16],
        [5, 25],
        [6, 36]
    ];

    $linea = new Linea($pizarra);

    for ($i = 0; $i < count($data)-1; $i++)
    {
        $origen = $data[$i];
        $destino = $data[$i+1];

        $linea->setOrigen($origen[0], 2 * $origen[1]);
        $linea->setDestino($destino[0], 2 *  $destino[1]);
        $linea->draw();
    }

    $origen = [0, 0];
    for ($x = 0; $x < 240; $x++)
    {

        $destino = [$x, 0.005 * $x*$x];

        $linea->setOrigen($origen[0], $origen[1]);
        $linea->setDestino($destino[0], $destino[1]);
        $linea->draw();

        $origen = $destino;
    }
    


    mostrarPizarra($pizarra);