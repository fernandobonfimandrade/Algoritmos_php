<?php
// Diferença entre datas dd/mm/aaaa
// gastei 1 h e 30 min para fazer.
// exemplo de chamada 3.php?inicial=12/12/1988&final=07/03/2021

class Data {
    public $meses = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    public $dia;
    public $mes;
    public $ano;
    public $numSegundos;
    public $numDias;

    private function Bissexto(){
        // um ano só é bissesto se for divisivel por 4 e ano for divisivel por 100
        // a nao ser que ele seja divisivel por 100 e tambem por 400
        return ($this->ano%4 == 0) && ($this->ano%100 != 0 || $this->ano% 400 == 0);
    }

    private function contaBissextos(){
        // conta quantos anos bissextos entre 1/1/1 ate o ano informado
        return intval(($this->ano-1)/4) - intval(($this->ano-1)/100) + intval(($this->ano-1)/400);
    }

    private function dataParaDias(){
        //meses de um ano nao bissesto
        // total dias de um ano vezes ano informado -1 
        $total = ($this->ano -1) * 365;

        for ($mes=1; $mes < $this->mes; $mes++) { 
            //adiciona a quantidade de dias do mes informado - 1 
            $total+= $this->meses[$mes-1];
        }
        // adiciona a quantidade de dias informado -1 
        $total += ($this->dia - 1) ;

        // conta quantos anos bissextos tiveram até a data informada
        $qtdDiasExtras = $this->contaBissextos();
        // soma a quantidade de dias extras dos anos bissextos
        $total += $qtdDiasExtras ;

        if($this->Bissexto() && $this->mes -1 >= 2){
            // se o ano atual é bissesto e o mes informado -1 é posterior a fevereiro 
            // soma um dia;
            $total +=  1;
        }

        $this->numDias = $total;
    }


    public function __construct($data){
        $data = explode('/',$data);
        if( ($data[0] > $this->meses[$data[1]-1] && $data[1] != 2) || ($data[0] > 29 && $data[1] == 2)  ){
            echo "\nData inválida erro : dia maior que o esperado para o mes\n";
            die;
        }
        if( $data[1] > 12 ){
            echo "\nData inválida erro : mes maior que 12\n";
            die;
        }
        if( $data[0] <= 0 ||  $data[1] <= 0 || $data[2] <= 0 ){
            echo "\nData inválida erro : dia, mes ou ano menor igual a 0\n";
            die;
        }
        $this->dia = $data[0];
        $this->mes = $data[1];
        $this->ano = $data[2];
        $this->dataParaDias();
    }


}


echo '<pre>';
$inicial = $_GET['inicial'];
echo "\nData Inicial = $inicial\n";
$final = $_GET['final'];
echo "\nData Final = $final\n";
$data1 = new Data($inicial);
$data2 = new Data($final);
echo "\nData Inicial quantidade de dias = ".$data1->numDias;
echo "\nData Final quantidade de dias = ".$data2->numDias;
echo "\nDiferença em dias = ".($data2->numDias - $data1->numDias);
echo '<pre>';
?>