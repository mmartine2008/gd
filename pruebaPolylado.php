<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Triangulo.php');
    require_once('lib/Point2D.php');
    require_once('lib/Poligono.php');
    require_once('lib/PolyLado.php');
    

    $canva = new Canva(640, 480);
    $canva->addCartesian();
    $black = $canva->createColor(0, 0, 0);

/*
    $n = 9;
    $inc = 2 * pi() / $n;
    $tita = 0;
    $lado = 100;
    $puntos = [];
    while ($tita < 2 * pi()) {
        $x = $lado * cos ($tita);
        $y = $lado * sin ($tita);
        
        $puntos[] = new Point2D($x, $y);
        $tita += $inc;
    }

    $p = new Poligono($canva, $puntos);
    $p->desplazar(50, 50);
    $p->draw();
    $p->draw();

*/

    for ($i = 3; $i < 15; $i++) {
        $p = new PolyLado($canva, new Point2D(50, 50), $i, $i*10 + 50);
   //     $c = $p->centroGeometrico();
   //     $p->desplazar(-$c->getX()/2, -$c->getY()/2);
        $p->draw();
    }

    $c = $p->centroGeometrico();
    $p->desplazar(-$c->getX()/2, -$c->getY()/2);
  //  $p->draw();

    $canva->draw('polylado.png');
    