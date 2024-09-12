<?php

    require_once('lib/Canva.php');
    require_once('lib/Rectangulo.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    for ($x = 0; $x < 30; $x++ ) {
        $xy0 = new Point2D(rand(-320, 320), rand(-240, 240));
        $w = rand(-320, 320);
        $h = rand(-240, 240);
        $r = new Rectangulo($canva, $xy0, $w, $h);
        $r->draw();
    }

    $canva->draw('file.png');