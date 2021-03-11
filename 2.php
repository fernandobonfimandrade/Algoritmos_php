<?php
// Ordenar array contendo no inicio partes de forma crescente e no fim impares de forma decrescente
// gastei 50 minutos para fazer.
// primeiro agrupo os pares no inicio e impares no fim
// ordenos os pares de forma crescente, e ordeno os impares de forma decrescente
// utilizei o algoritmo inser sort para ordenar os elementos.
// exemplo de chamada 2.php?vetor[]=5&vetor[]=6&vetor[]=2&vetor[]=9&vetor[]=1&vetor[]=4&vetor[]=8&vetor[]=7&vetor[]=3
function agruparParInicio(&$array){
    // guardo o indice do primeiro elemento pois é onde irei incerir o primeiro par encontrado
    $idx = 0;
    // percorro toda a array
    for ($i=1; $i < count($array); $i++) { 
        // guardo o elemento do indice salvo
        $aux = $array[$idx];
        // econtro um elemento par
        if($array[$i] % 2 == 0){
            // coloco o elemento encontrado no indice salvo
            $array[$idx] = $array[$i];
            // coloco o elemento salvo na posição do par encontrado
            $array[$i] = $aux;
            // atualizo o indice para a proxima posição
            $idx++;
        }
    }
    return $idx-1;
}

// insert sort acendente
function insertSortASC(&$array, $inicio, $fim){
    // percorro todo o vetor até a posicao final - 1 (pois o insert sort trabalhará do inicio +1 até o final)
    for($i = $inicio; $i <= $fim-1; $i++){
        // guardo o indice atual
        $idx = $i;
        // percorro o vetor da posicao atual + 1 até o fim
        for($j = $i+1;$j <= $fim; $j++){
            // localizo o menor elemento da array
            if($array[$j] < $array[$idx]){
                // atualizo o indice para a posição deste elemento menor
                $idx = $j;
            }
        }
        // guardo o elemento da posicao atual do primeiro laço (que sempre será a posição correta para inserir o menor elemento da vez)
        $aux = $array[$i];
        // coloco o menor elemento encotrado na posição correta ordenada
        $array[$i] = $array[$idx];
        // coloco o elemento salvo na posição do menor encontrado
        $array[$idx] = $aux;
    }
    return;
}
// insert sort descendente
function insertSortDESC(&$array, $inicio, $fim){
    // percorro todo o vetor até a posicao final - 1 (pois o insert sort trabalhará do inicio +1 até o final)
    for($i = $inicio; $i <= $fim-1; $i++){
        // guardo o indice atual
        $idx = $i;
        // percorro o vetor da posicao atual + 1 até o fim
        for($j = $i+1;$j <= $fim; $j++){
            // localizo o maior elemento da array
            if($array[$j] > $array[$idx]){
                // atualizo o indice para a posição deste elemento maior
                $idx = $j;
            }
        }
        // guardo o elemento da posicao atual do primeiro laço (que sempre será a posição correta para inserir o maior elemento da vez)
        $aux = $array[$i];
        // coloco o maior elemento encotrado na posição correta ordenada
        $array[$i] = $array[$idx];
        // coloco o elemento salvo na posição do maior encontrado
        $array[$idx] = $aux;
    }
    return;
}


echo '<pre>';
echo "\nEste é o vetor original\n";
$array = $_GET['vetor'];
print_r($array);
echo "\nAgrupar pares no inicio.\n";
$ultimoPar = agruparParInicio($array);
print_r($array);
echo "\nOrdenar pares forma Crescente.\n";
insertSortASC($array, 0, $ultimoPar);
print_r($array);
echo "\nOrdenar impares forma decrescente.\n";
insertSortDESC($array, $ultimoPar+1, count($array));
print_r($array);
echo '<pre>';
?>