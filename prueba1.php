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

$canva->moveTo(0, 240);
$canva->lineTo(0, -240, $negro);

$y = 0.1 * 1000 *  10000;
$canva->moveTo(-1000, $y);
for ($x = -1000; $x < 1000; $x = $x + 0.1) {
    $y = 0.1 * $x *  $x;
    $canva->lineTo($x, $y, $rojo);

}


$canva->draw('file.png');