<?php 

function validarCPF($cpf){
    $cpf = preg_replace('/[^0-9]/', "", $cpf);
    $validade=true;
    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)){
        $validade=false;
        return $validade;
    }else{
    $cpf = str_split($cpf, 1);
    $numMult = 10;
    $soma = 0;
    $result1 = 0;

    for($i=0;$i<9;$i++){
        $soma += $cpf[$i] * $numMult;
        $numMult--;
    }
$result1 = ($soma * 10)%11;

    $numMult2 = 11;
    $soma2=0;
    $result2 = 0;

    for($i=0;$i<10;$i++){
        $soma2 += $cpf[$i] * $numMult2;
        $numMult2--;
    }
$result2 = ($soma2 * 10)%11;

        if($result1 =! $cpf[9] or $result2 != $cpf[10]){
            $validade=false;
            return $validade;
        }else{
            $validade=true;
            return $validade;
        }
    }
}