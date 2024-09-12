<?php

    require_once('lib/Canva.php');
    require_once('lib/Recta.php');
    require_once('lib/Point2D.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    $xy0 = new Point2D(0, 0);
    for ($x = 0; $x < 30; $x++ ) {

        $xy1 = new Point2D(rand(-320, 320), rand(-240, 240));
        $r = new Recta($canva, $xy0, $xy1);
        $r->draw();
        $xy0 = $xy1;
    }

    $canva->draw('file.png');