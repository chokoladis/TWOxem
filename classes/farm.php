<?
namespace village\classes;

class farm{

    public $error = '';

    // create animal
    public $idAnimal = 0;
    public $postfix = 0;
    public $arrIdAnimals = [];
    public $arrCountAnimals = [];

    // productions
    public $allReceivedProducts = [];
    public $day = 0;
    
    // add and counting animals
    function getIdAnimals() { return $this->arrIdAnimals; }
    function addAnimal($codeAnimal, $nameAnimal, $prod, $issuedProd_min, $issuedProd_max, $unit) { 
        $this->arrIdAnimals[$this->generateId()] = [ 
            'code' => $codeAnimal,
            'name' => $nameAnimal,
            'prod' => $prod,
            'issuedProd_min' => $issuedProd_min,
            'issuedProd_max' => $issuedProd_max,
            'unit' => $unit
        ];
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

    function getCountAnimals() { return $this->arrCountAnimals; }
    
    function countingAnimal(){
        $tempArray = [];
        foreach ($this->getIdAnimals() as $id => $value){

            $code = $value['code'];
            $name = $value['name'];

            if (empty($tempArray[$code])){
                $tempArray[$code]['qty'] = 1;
            } else {
                $tempArray[$code]['qty'] += 1;
            }

            $tempArray[$code]['name'] = $name;
        }

        $response = "";
        foreach ($tempArray as $code){
            $response .= "<br>На ферме имеется $code[qty] $code[name]";
        }
        
        // Обновляем переменную с количеством животных
        $this->arrCountAnimals = $tempArray;
        return $response;        
    }


    // work with production

    function getProd($min,$max){
        $qtyProd = rand($min, $max);
        return $qtyProd;
    }

    function nextDay(){
        return $this->day++;
    }

    // сбор продукции со всех коров/куриц за раз/день
    function getAllProd(){

        if (empty($this->getIdAnimals())){
            $error .= 'Ошибка: количество животных на ферме меньше 1';
        } else {

            foreach ($this->getIdAnimals() as $id => $arrAnimal){
                $code = $arrAnimal['code'];
                $name = $arrAnimal['name'];
                $prod = $arrAnimal['prod'];
                $unit = $arrAnimal['unit'];
                $minProd = $arrAnimal['issuedProd_min'];
                $maxProd = $arrAnimal['issuedProd_max'];
                
                if ($this->allReceivedProducts[$code]['qtyProd'] != 0){
                    $this->allReceivedProducts[$code]['qtyProd'] += $this->getProd($minProd,$maxProd);
                } else {
                    $this->allReceivedProducts[$code] = [
                        'name' => $name,
                        'qtyProd' => $this->getProd($minProd,$maxProd),
                        'prod' => $prod,
                        'unit' => $unit
                    ];
                }
            }
            
            $this->nextDay();
        }       
        
    }

    function infoQtyProducts(){
        $response = "";
        foreach($this->allReceivedProducts as $animal){
            $response .= "<br>За $this->day дней $animal[name] произвел(а/и) - $animal[qtyProd] $animal[unit] $animal[prod]";
        }
        return $response;
    }

}
?>