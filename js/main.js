function Mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("exeMascara()",1)
}

function exeMascara(){
    v_obj.value=v_fun(v_obj.value)
}

function mtelefone(v){
    v=v.replace(/\D/g,"");//Remove tu o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2");//Coloca tudo em parênteses em volta dos 2 primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");//Coloca hífen entre o quarto e o quinto dígitos
    return v; 
}

function mCPF(v){
    v=v.replace(/\D/g,"");
    return v;
}

function id(el){
    return document.getElementById(el);
}
window.onload = function(){
    id('telefone').onkeyup = function(){
        Mascara(this, mtelefone)
    }

    id('cpf').onkeyup = function(){
        Mascara(this,mCPF)
    }
}

