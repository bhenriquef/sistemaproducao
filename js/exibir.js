var nome = "", nomeantigo = "";
var cont = 0;
function exibirIframe(nome)
{
    document.getElementById(nome).style.display = "block";
    if(cont > 0){
        if(nome != nomeantigo){
            document.getElementById(nomeantigo).style.display = "none";
            nomeantigo = nome;
        }
    }
    else{
        nomeantigo = nome;
    }
    cont++;
}