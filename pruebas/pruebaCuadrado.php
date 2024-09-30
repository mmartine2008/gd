<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Cuadrado.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    $c = new Cuadrado($canva, new Point2D(0,0), 200);
    $c->draw();

    $canva->draw('file.png');