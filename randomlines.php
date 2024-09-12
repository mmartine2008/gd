<?php

    require_once('lib/Canva.php');

    $canva = new Canva(640, 480);
    $canva->addCartesian();

    $black = $canva->createColor(0, 0, 0);

    for ($x = 0; $x < 30; $x++ ) {
        $canva->lineTo(rand(-320, 320), rand(-240, 240), $black);
    }

    $canva->draw('file.png');