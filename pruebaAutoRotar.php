<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Triangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

    $t1 = new Triangulo($canva, new Point2D(0, 0), new Point2D(20, 100), new Point2D(50, 0));
    $t1->desplazar(50, 50);

    $t1->draw();


    $c = $t1->centroGeometrico();
    $c1 = new Circulo($canva, $c, 10);
    $c1->draw($canva->createColor(255, 0, 0));
    
    $t1->desplazar(-$c->getX()/2, -$c->getY()/2);
    $t1->rotar(1/3 * pi());
    $t1->desplazar($c->getX()/2, $c->getY()/2);
    $t1->draw();

    $t1->autoRotar(1/3 * pi());
    $t1->draw();

    $canva->draw('autorotacion.png');
    