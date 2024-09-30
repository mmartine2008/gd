<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Cuadrado.php');
    require_once('lib/Point2D.php');
    require_once('lib/Animacion.php');

    
    $animacion = new Animacion(640, 480);
    $black = $animacion->getCanva()->createColor(0, 0, 0);


    for ($x = 0; $x < 30; $x++ ) {
        $xy0 = new Point2D(rand(-320, 320), rand(-240, 240));
        $w = rand(-320, 320);
        $h = rand(-240, 240);
        $r = new Rectangulo($animacion->getCanva(), $xy0, $w, $h);
        $r->draw();

        $animacion->addFrame(true);
    }

    $animacion->make('todo.gif');
    