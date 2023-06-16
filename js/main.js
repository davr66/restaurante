function Mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("exeMascara()",1)
}

function exeMascara(){
    v_obj.value=v_fun(v_obj.value)
}

function mtelefone(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2");//Coloca tudo em parênteses em volta dos 2 primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");//Coloca hífen entre o quarto e o quinto dígitos
    return v; 
}

function mCPF(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
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

function keypressed( obj , e ) { //APENAS NUMEROS E VIRGULA
    var tecla = ( window.event ) ? e.keyCode : e.which;
    var texto = document.getElementById("numerosVirgula").value
    var indexvir = texto.indexOf(",")
    var indexpon = texto.indexOf(".")
   
   if ( tecla == 8 || tecla == 0 )
       return true;
   if ( tecla != 44 && tecla != 46 && tecla < 48 || tecla > 57 )
       return false;
   if (tecla == 44) { if (indexvir !== -1 || indexpon !== -1) {return false} }
   if (tecla == 46) { if (indexvir !== -1 || indexpon !== -1) {return false} }
}

function somenteNumeros(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace   
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0   
        // charCode 57 equivale a 9
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}
