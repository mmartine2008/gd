<?php

    require_once('lib/Canva.php');
    require_once('lib/Poligono.php');
    require_once('lib/Elipse.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    $e = new Elipse($canva, new Point2D(0, 0), 120, 250);
    $e->draw();

    $canva->draw('file.png');