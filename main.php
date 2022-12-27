<?
require_once('config.php');

use village\classes\farm;
use village\classes\farm\animal;
use village\classes\farm\animal\cow;
use village\classes\farm\animal\chiken;

$farm = new farm();

// Создание коров на ферме
$i = 0;
while($i < 10){
    $farm->addAnimal(
        cow::$typeAnimalCode,
        cow::$typeAnimal,
        cow::$nameProd,
        cow::$issuedProd_min,
        cow::$issuedProd_max,
        cow::$unit
    );
    $i++;
}

// Создание куриц на ферме
$i = 0;
while($i < 20){
    $farm->addAnimal(
        chiken::$typeAnimalCode,
        chiken::$typeAnimal,
        chiken::$nameProd,
        chiken::$issuedProd_min,
        chiken::$issuedProd_max,
        chiken::$unit
    );
    $i++;
}

echo '<br>'.$farm->countingAnimal();

// Собираем неделю урожай)
$d = 0;
while($d < 7){
    $farm->getAllProd();
    $d++;
}

echo '<br>'.$farm->infoQtyProducts();

$i = 0;
while($i < 5){
    $farm->addAnimal(
        chiken::$typeAnimalCode,
        chiken::$typeAnimal,
        chiken::$nameProd,
        chiken::$issuedProd_min,
        chiken::$issuedProd_max,
        chiken::$unit
    );
    $i++;
}

$farm->addAnimal(
    cow::$typeAnimalCode,
    cow::$typeAnimal,
    cow::$nameProd,
    cow::$issuedProd_min,
    cow::$issuedProd_max,
    cow::$unit
);

echo '<br>'.$farm->countingAnimal();

$nextWeek = $d+7;
while($d < $nextWeek){
    $farm->getAllProd();
    $d++;
}

echo '<br>'.$farm->infoQtyProducts();

?>