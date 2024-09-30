<?php

    require_once('lib/Canva.php');
    require_once('lib/Poligono.php');
    require_once('lib/Circulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    $c = new Circulo($canva, new Point2D(0, 0), 50);
    $c->draw();

    $canva->draw('file.png');