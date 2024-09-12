<?php

    require_once('lib/Canva.php');
    require_once('lib/Poligono.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);
    $puntos = [];

    for ($x = 0; $x < 5; $x++ ) {
        $xy0 = new Point2D(rand(-320, 320), rand(-240, 240));
        $puntos[] = $xy0;
    }

//    $poly = new Poligono($canva, [new Point2D(0, 0), new Point2D(100, 100), new Point2D(100, -100)]);
    $poly = new Poligono($canva, $puntos);
    $poly->draw();

    $canva->draw('file.png');