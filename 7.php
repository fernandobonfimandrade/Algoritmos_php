<?php
// dado um grafo, listar os caminho de entre A e E
// gastei 4 horas para fazer.
// exemplo de chamada 7.php?vertices=A;B;C;D;E;F;G&arestas=A,B;A,D;B,C;B,D;B,E;C,E;D,E;D,F;E,F;E,G;F,G&inicial=A&final=E

// esse algoritimo so funciona para retangulos paralelos ao eixo x
class Grafo {
    public $listaDeAdjavencia;
    public $caminhos;

    public function __construct($vertices,$arestas){
        $this->matrizAdjacencia = array();
        $this->iniciaVertices($vertices);
        $aux = explode(';',$arestas);
        foreach ($aux as $key => $value) {
            $this->addAresta($value);
        }
    }

    public function iniciaVertices($vertices){
        $aux = explode(';',$vertices);
        foreach ($aux as $key => $vertice) {
            $this->listaDeAdjavencia[$vertice] = array();
        }
    }
    public function addAresta($aresta){
        $aux = explode(',',$aresta);
        $this->listaDeAdjavencia[$aux[0]][] = $aux[1];
        $this->listaDeAdjavencia[$aux[1]][] = $aux[0];
    }

    private function ContinuaCaminho($inicial,$final, $visitados, &$caminho){
        if($inicial == $final){
            $this->caminhos[] = implode(' -> ',$caminho);
            return ;
        }

        $visitados[] = $inicial;
        foreach ($this->listaDeAdjavencia[$inicial] as $key => $proximo) {
            if(!in_array($proximo,$visitados)){
                $caminho[] = $proximo;
                $this->ContinuaCaminho($proximo,$final, $visitados, $caminho);
                //apois a conclusao do caminho remove o elemento do caminho
                $caminho = array_diff($caminho,array($proximo));
            }
        }
        //apos passar por todos os adjacentes remove o elemento dos visiados 
        $visitados = array_diff($visitados,array($inicial));
    }


    public function encontraCaminhos($inicial,$final){

        $visitados = array();
        $caminho = array();
        $this->caminhos = array();

        $caminho[] = $inicial;

        $this->ContinuaCaminho($inicial,$final, $visitados, $caminho);

    }
}


echo '<pre>';
$vertices = $_GET['vertices'];
$arestas = $_GET['arestas'];
$inicial = $_GET['inicial'];
$final = $_GET['final'];
$grafo = new Grafo($vertices,$arestas);
$grafo->encontraCaminhos($inicial,$final);
print_r($grafo->caminhos);
echo '<pre>';
?>