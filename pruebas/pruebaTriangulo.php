<?php

    require_once('lib/Canva.php');
    require_once('lib/Poligono.php');
    require_once('lib/Triangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    $t = new Triangulo($canva, new Point2D(0, 0), new Point2D(100, 100), new Point2D(100, -100));
    $t->draw();

    $canva->draw('file.png');