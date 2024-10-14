<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Triangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

    $r1 = new Rectangulo($canva, new Point2D(-100, 0), 100, 150);
    $r2 = new Rectangulo($canva, new Point2D(-50, 50), 200, 150);

    $t1 = new Triangulo($canva, new Point2D(0, 0), new Point2D(20, 100), new Point2D(50, 0));
    $t1->desplazar(-50, -10);

    $r1->draw();
    $r2->draw();
    $t1->draw();

    if ($r1->intersecta($r2)) {
    //    echo "Se intersectan";
    }

    if ($r1->intersecta($t1)) {
        //    echo "Se intersectan";
        }
    
    $canva->draw('rectangulo.png');
    