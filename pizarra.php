<?php

    function crearPizarra($width, $height) {
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255); // Blanco
        imagefill($image, 0, 0, $white);

        return $image;
    }

    function tracePoints($data, $image) {
        $lineColor = imagecolorallocate($image, 0, 0, 0); // Negro

        for ($i = 1; $i < count($data) -1; $i++) {
            $ant = $data[$i -1];
            $pos = $data[$i];

            imageline($image, $ant[0]*10, $ant[1] *10, $pos[0]*10, $pos[1]*10, $lineColor); // Eje X

        }
    }

    function mostrarPizarra($image) {
        header("Content-type: image/png");
        imagepng($image);
        
    }

    $gd = crearPizarra(640, 480);

    $data = [
        [0, 0],
        [1, 1],
        [2, 4],
        [3, 9],
        [4, 16],
    ];

    tracePoints($data, $gd);

    mostrarPizarra($gd);