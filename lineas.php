<?php

require_once('lib/Canva.php');

$canva = new Canva(640, 480);

$blanco = $canva->createColor(255, 255, 255);
$negro = $canva->createColor(0, 0, 0);
$rojo = $canva->createColor(255, 0, 0);

$canva->setBackground($blanco);

$canva->texto(0,0, '(0, 0)');
$canva->texto(-320,220, '(-320, 240)');
$canva->texto(-320,-220, '(-320, -240)');

$canva->texto(200,220, '(320, 240)');
$canva->texto(200,-220, '(320, -240)');

$canva->moveTo(-320, 0);
$canva->lineTo(320, 0, $negro);

$canva->moveTo(0, 0);
for ($lineas = 0; $lineas < 25; $lineas++) {
    $x = rand(-320, 320);
    $y = rand(-240, 240);
    $canva->lineTo($x, $y, $canva->createColor(rand(0,255), rand(0,255), rand(0,255)));
}


$canva->draw('file.png');