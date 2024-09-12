<?php

    require_once('lib/Canva.php');

    $canva = new Canva(640, 480);

    $black = $canva->createColor(255, 255, 255);
    $white = $canva->createColor(0, 0, 0);

    $canva->setBackground($white);
    $canva->texto(5, 20, "(0, 0)");
    $canva->texto(580, 20, "(640, 0)");
    $canva->texto(5, 460, "(0, 480)");
    $canva->texto(560, 460, "(640, 480)");

    $canva->moveTo(-1000, 0.005 * -1000 * -1000);
    for ($x = -1000; $x < 1000; $x = $x+ 0.05 ) {
        $canva->lineTo($x, 0.005 * $x * $x, $black);
    }

    $canva->draw('file.png');