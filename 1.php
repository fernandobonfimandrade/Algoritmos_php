<?php
// Rotacionar um array K posições a esquerda
// gastei 20 minutos para fazer.
// A rotação a esquerda se trata de uma fila FIFO
// retira no inicio e insere no fila.
// remover um elemento no inicio e inserir no final da array.
// outra forma de resolver seria usando as funções nativas array_shift() e array_push().
// exemplo de chamada 1.php?k=5
function rotacionaArray($array,$k, $tamanho ){
    for ($i=1; $i <= $k; $i++) { 
        $num = $array[0];
        for ($j=1; $j < $tamanho ; $j++) { 
            $array[$j-1] = $array[$j];
        }
        $array[$j-1] = $num;
    }
    return $array;
}


echo '<pre>';
echo "\nEste é o vetor original\n";
$array = [1,2,3,4,5,6,7,8,9];
$tamanho = count($array);
print_r($array);
$k = $_GET['k'];
if( is_numeric($k) && $k <= $tamanho  ){
    $array = rotacionaArray($array,$k, $tamanho );
    echo "\nRotacionar $k elementos a direita.\n";
    print_r($array);
}else{
    echo "\nValor de k = '$k' é invalido, informe um numero inteiro menor igual a $tamanho .\n";
}
echo '<pre>';
?>