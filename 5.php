<?php
// verificar sobreposicao de retangulos e calcular a area sobreposta
// gastei 10 min para fazer.
// exemplo de chamada 5.php?texto=Um velho cruza a soleira De botas longas, de barbas longas De ouro o brilho do seu colar Na laje fria onde coarava Sua camisa e seu alforje De caçador O meu velho e invisível Avôhai&subTexto=caçador

function buscarString($texto,$subTexto){
    for ($i=0; $i < count($texto); $i) { 
        $match = 0;
        for ($j=0; $j < count($subTexto); $j++) { 
            if($texto[$i] == $subTexto[$j]){
                $match++;
                $i++;
            }else{
                $match = 0;
                $i++;
                break;
            }
        }
        if($match == count($subTexto)){
                return true;
        }
    }
    return false;
}


echo '<pre>';
$texto = str_split($_GET['texto']);
$subTexto = str_split($_GET['subTexto']);
echo (buscarString($texto,$subTexto) ? 'achou' : 'não achou');
echo '<pre>';
?>