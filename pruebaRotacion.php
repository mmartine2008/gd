<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Triangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

    $r1 = new Rectangulo($canva, new Point2D(-100, 0), 100, 150);
    $t1 = new Triangulo($canva, new Point2D(0, 0), new Point2D(20, 100), new Point2D(50, 0));
    $t1->desplazar(-50, -10);

    $r1->draw();
    $t1->draw();

    // 2 pi = 360
    //   pi = 180
    // 1/2 pi = 90
    // 1/4 pi = 45
    $t1->rotar(1/3 * pi());
    $t1->draw();

    $t1->rotar(0.25 * pi());
    $t1->draw();

    $r1->rotar(0.25 * pi());
    $r1->draw();

    $t1->centroGeometrico();
    $r1->centroGeometrico();
  
    $canva->draw('rotacion.png');
    