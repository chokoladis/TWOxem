<?
namespace village\classes\farm;

abstract class animal{

    public $typeAnimalCode = 'none';
    public $typeAnimal = 'non choise';
    
    public $nameProd = '';
    public $unit = '';
    public $issuedProd_min = 0;
    public $issuedProd_max = 0;

    function __contruct(){
        
    }

}