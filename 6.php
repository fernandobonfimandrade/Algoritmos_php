<?php
// verificar sobreposicao de retangulos e calcular a area sobreposta
// gastei 2 horas para fazer.
// exemplo de chamada 6.php?coord[]=0,0&coord[]=2,2&coord[]=2,0&coord[]=0,2&coord[]=1,0&coord[]=1,2&coord[]=6,0&coord[]=6,2

// esse algoritimo so funciona para retangulos com lado paralelo ao eixo x
class Retangulo {
    public $a;
    public $b;
    public $c;
    public $d;
    public $menorX;
    public $maiorX;
    public $menorY;
    public $maiorY;
    public $largura;
    public $altura;

    public function __construct($a,$b,$c,$d){
        $this->a = explode(',',$a);
        $this->menorX = $this->a[0];
        $this->maiorX = $this->a[0];
        $this->menorY = $this->a[1];
        $this->maiorY = $this->a[1];
        $this->b = explode(',',$b);
        $this->menorX = $this->menorX > $this->b[0] ? $this->b[0] : $this->menorX;
        $this->maiorX = $this->maiorX < $this->b[0] ? $this->b[0] : $this->maiorX;
        $this->menorY = $this->menorY > $this->b[1] ? $this->b[1] : $this->menorY;
        $this->maiorY = $this->maiorY < $this->b[1] ? $this->b[1] : $this->maiorY;
        $this->c = explode(',',$c);
        $this->menorX = $this->menorX > $this->c[0] ? $this->c[0] : $this->menorX;
        $this->maiorX = $this->maiorX < $this->c[0] ? $this->c[0] : $this->maiorX;
        $this->menorY = $this->menorY > $this->c[1] ? $this->c[1] : $this->menorY;
        $this->maiorY = $this->maiorY < $this->c[1] ? $this->c[1] : $this->maiorY;
        $this->d = explode(',',$d);
        $this->menorX = $this->menorX > $this->d[0] ? $this->d[0] : $this->menorX;
        $this->maiorX = $this->maiorX < $this->d[0] ? $this->d[0] : $this->maiorX;
        $this->menorY = $this->menorY > $this->d[1] ? $this->d[1] : $this->menorY;
        $this->maiorY = $this->maiorY < $this->d[1] ? $this->d[1] : $this->maiorY;

        $this->largura = $this->maiorX - $this->menorX;
        $this->altura = $this->maiorY - $this->menorY;

    }

    public function sobreposto(Retangulo  $retangulo2){
        if ($this->menorX < $retangulo2->menorX + $retangulo2->largura &&
                $this->menorX + $this->largura > $retangulo2->menorX &&
                $this->menorY < $retangulo2->menorY + $retangulo2->altura &&
                $this->menorY + $this->altura > $retangulo2->menorY) {
                return true;
            }
        return false;
    }

    public function montaPlanoCartesiano(Retangulo $retangulo2){
        $maiorXCalc = $this->maiorX > $retangulo2->maiorX ? $this->maiorX : $retangulo2->maiorX;
        $maiorYCalc = $this->maiorY > $retangulo2->maiorY ? $this->maiorY : $retangulo2->maiorY;

        $planoCart = array();
        for ($X=0; $X <= $maiorXCalc-1; $X++) { 
            for ($Y=0; $Y <= $maiorYCalc-1; $Y++) { 
                $planoCart[$X][$Y] = 0;
                if($X >= $this->menorX && $X < $this->maiorX
                    && $Y >= $this->menorY && $Y < $this->maiorY){
                        $planoCart[$X][$Y]++;
                }
                if($X >= $retangulo2->menorX && $X < $retangulo2->maiorX
                && $Y >= $retangulo2->menorY && $Y < $retangulo2->maiorY){
                    $planoCart[$X][$Y]++;
                }
            }
        }
        // print_r($planoCart);
        return $planoCart;
    }

    public function CalculaAreaSobreposta(Retangulo  $retangulo2){

        $planoCart = $this->montaPlanoCartesiano($retangulo2);
        $area = 0;
        for ($X=0; $X < count($planoCart); $X++) { 
            for ($Y=0; $Y < count($planoCart[$X]); $Y++) { 
                if($planoCart[$X][$Y] == 2){
                    $area++;
                }
            }
        }
        return "area sobreposta é ".$area." unidades quadradas";
    }


}


echo '<pre>';
$coord = $_GET['coord'];
$ret1 = new Retangulo($coord[0],$coord[1],$coord[2],$coord[3]);
$ret2 = new Retangulo($coord[4],$coord[5],$coord[6],$coord[7]);
// print_r($ret1);
// print_r($ret2);
echo "\n".($ret1->sobreposto($ret2) ? $ret1->CalculaAreaSobreposta($ret2) : 0);
echo '<pre>';
?>