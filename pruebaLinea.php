<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

    $r = new Rectangulo($canva, new Point2D(-100, 50), 100, 150);
    $r->draw();
    $canva->draw('rectangulo.png');
    