<?php

require_once('lib/Canva.php');

function calcularPi($lim) {
    $acum = 0;
    for ($n = 0; $n < $lim; $n++) {
        $acum += ((($n%2 == 0) ? 1 : -1))*(1/($n*2+1));
    }
    return ($acum * 4);
}

$canva = new Canva(640, 480);

$blanco = $canva->createColor(255, 255, 255);
$negro = $canva->createColor(0, 0, 0);
$rojo = $canva->createColor(255, 0, 0);

$canva->setBackground($blanco);

//$canva->texto(0,0, '(0, 0)');
$canva->texto(-320,220, '(-320, 240)');
$canva->texto(-320,-220, '(-320, -240)');

$canva->texto(200,220, '(320, 240)');
$canva->texto(200,-220, '(320, -240)');

$canva->moveTo(-320, 0);
$canva->lineTo(320, 0, $negro);

$xZoom = 10;
$yZoom = 80;

$canva->moveTo(0, 0);
for ($lim = 0; $lim < 50; $lim = $lim + 1) {
    $miPi = calcularPi($lim) - 3.1415;
    $canva->lineTo(round($xZoom * $lim), round($yZoom * $miPi), $negro);
}


$canva->draw('file.png');