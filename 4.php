<?php
// verificar quantos triangulos possiveis com os valoes 
// gastei 20 min para fazer.
// exemplo de chamada 4.php?a=100&b=6&c=20&d=2&e=200&f=15
class Triangulo {
    public $a;
    public $b;
    public $c;

    public function __construct($a,$b,$c){
       
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function verdadeiro(){
        // um triangulo existe se somente se a soma das medidas de dois lados é sempre maior que a medida do terceiro.
        if( ($this->a + $this->c > $this->b) && ($this->a + $this->b > $this->c) && ($this->c + $this->b > $this->a ) ){
            return true;
        }
    }


}


echo '<pre>';
$entrada = array();
$entrada['A'] = $_GET['a'];
$entrada['B'] = $_GET['b'];
$entrada['C'] = $_GET['c'];
$entrada['D'] = $_GET['d'];
$entrada['E'] = $_GET['e'];
$entrada['F'] = $_GET['f'];

$triangulos = array();

foreach ($entrada as $key1 => $a) {
    foreach ($entrada as $key2 => $b) {
        foreach ($entrada as $key3 => $c) {
            $triangulo = new Triangulo($a,$b,$c);
            if($triangulo->verdadeiro()){
                $triangulos[] = "[".$key1.$key2.$key3."]";
            }
        }
    }
}

if(count($triangulos) > 0){
    echo "\nTriângulos possíveis : ".count($triangulos)."\n";
    print_r($triangulos);
}else{
    echo "\nNenhum triangulo é possível";
}

echo '<pre>';
?>