<?
namespace vilage;

class farm{

    public $error = '';
    public $idAnimal = 0;
    public $postfix = 0;
    public $arrayIdAnimals = [];

    public function getArrayAnimals() { return $this->arrayIdAnimals; }
    public function addAnimal($typeAnimalCode) { 
        $this->arrayIdAnimals[$this->generateId()] = $typeAnimalCode;
    }

    function generateId(){
        if ($this->idAnimal == 0 || $this->idAnimal == date('Ymd')){
            $this->setPostfix(true);
        } else {
            $this->setPostfix(false);
        }
        $newID = date('Ymd').'_'.$this->postfix;
        $this->setidAnimal($newID);
        return $newID;
    }

    function setidAnimal($id){
        $this->idAnimal = $id;
    }
    function setPostfix($resetPostfix){
        if ($resetPostfix){
            $this->postfix = 1;
        } else {
            $this->postfix++;
        }
    }
}

class animals{

    public $typeAnimalCode = 'none';
    public $typeAnimal = 'non choise';
    public $nameProd = '';
    public $unit = '';
    
    public $issuedProd_min = 0;
    public $issuedProd_max = 0;
    public $allReceivedProducts = 0;
    public $day = 0;
    public $qtyAnimal = 0;

    function __contruct(){
        
    }

    function getName(){
        return $this->typeAnimal;
    }
    function getCode(){
        return $this->typeAnimalCode;
    }

    function getProd(){
        $qtyProd = rand($this->issuedProd_min, $this->issuedProd_max);
        $this->allReceivedProducts += $qtyProd;
        // echo $this->getProd_log($qtyProd);
    }

    function getProd_log($qty){
        $response = "<br> $this->typeAnimal произвел(а) $qty $this->unit $this->nameProd";
        $response .= "<br> вообщем мы имеем $this->allReceivedProducts $this->nameProd";
        return $response;
    }

    function plusAnimal(){
        return $this->qtyAnimal++;
    }
    function nextDay(){
        return $this->day++;
    }

    // сбор продукции со всех коров/куриц за раз/день
    function getAllProd(){
        if ($this->qtyAnimal > 0){
            $i = 1;
            while ($i<=$this->qtyAnimal){
                // echo "<br>--$i--<br>";
                $this->getProd();
                $i++;
            }
        } else{
            $error .= 'Ошибка: количество животных на ферме меньше 1';
        }
        $this->nextDay();
    }

    function infoQtyProducts(){
        return "За $this->day дней $this->typeAnimal произвел(а/и) $this->allReceivedProducts $this->unit";
    }

    function infoFarmAnimals($arrayAnimals,$typeAnimal,$nameAnimal){
        $qty = 0;
        foreach ($arrayAnimals as $id => $value){
            if ($value == $typeAnimal){
                $qty++;
            }
        }
        return "На ферме имеется $qty $nameAnimal";
    }

}

class chiken extends animals{

    public $typeAnimalCode = 'chiken';
    public $typeAnimal = 'куриц(а/ы)';
    public $nameProd = 'яиц(о/а)';
    public $issuedProd_min = 0;
    public $issuedProd_max = 1;
    public $unit = 'шт';

    function __contruct(){

    }
    
}

class cow extends animals{

    public $typeAnimalCode = 'cow';
    public $typeAnimal = 'коров(а/ы)';
    public $nameProd = 'молоко(а)';
    public $issuedProd_min = 8;
    public $issuedProd_max = 12;
    public $unit = 'литр';

    function __contruct(){

    }
    
}

$farm = new farm();

// Создание коров на ферме
$cow = new cow();

$i = 0;
while($i < 10){
    $farm->addAnimal($cow->getCode());
    $cow->plusAnimal();
    $i++;
}

// // Создание куриц на ферме
$chiken = new chiken();
$i = 0;
while($i < 20){
    $farm->addAnimal($chiken->getCode());
    $chiken->plusAnimal();
    $i++;
}

// var_dump($farm->getArrayAnimals());
echo "<br>";
echo $cow->infoFarmAnimals($farm->getArrayAnimals(),$cow->getCode(),$cow->getName());
echo "<br>";
echo $chiken->infoFarmAnimals($farm->getArrayAnimals(),$chiken->getCode(),$chiken->getName());


// // Собираем неделю урожай)
$d = 0;
while($d < 7){
    // echo "<b>day - $d</b>";
    $cow->getAllProd();
    $chiken->getAllProd();  
    $d++;
}

echo "<br>";
echo $cow->infoQtyProducts();
echo "<br>";
echo $chiken->infoQtyProducts();

$i = 0;
while($i < 5){
    $farm->addAnimal($chiken->getCode());
    $chiken->plusAnimal();
    $i++;
}

$farm->addAnimal($cow->getCode());
$cow->plusAnimal();

echo "<br>";
echo $cow->infoFarmAnimals($farm->getArrayAnimals(),$cow->getCode(),$cow->getName());
echo "<br>";
echo $chiken->infoFarmAnimals($farm->getArrayAnimals(),$chiken->getCode(),$chiken->getName());

$nextWeek = $d+7;
while($d < $nextWeek){
    // echo "<b>day - $d<b>";
    $cow->getAllProd();
    $chiken->getAllProd();  
    $d++;
}

echo "<br>";
echo $cow->infoQtyProducts();
echo "<br>";
echo $chiken->infoQtyProducts();
// var_dump($farm->getArrayAnimals());

// ?>