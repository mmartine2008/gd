<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

    $r1 = new Rectangulo($canva, new Point2D(-100, 50), 100, 150);
    $r2 = new Rectangulo($canva, new Point2D(-50, 100), 100, 150);

    $r1->draw();
    $r2->draw();

    if ($r1->intersecta($r2)) {
        echo "Se intersectan";
    }

    $canva->draw('rectangulo.png');
    