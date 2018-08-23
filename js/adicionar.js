var cont = 0; //variavel para contar quantas vezes a function rodou
function addlabel() { //function para adicionar novo input do tipo texto
    //adiciona um novo imput para escrevar as cores do tecido
    document.getElementById("aqui").innerHTML+="<input class='form-control' size='10' type='text' id='cor"+cont+"' name='cor"+cont+"' placeholder='insira a cor'>" +
          "-<input class='form-control' type='number' size='2' step='any' id='quant"+cont+"' name='quant"+cont+"' placeholder='Insira a quantidade'><br>";
    cont++; //adiciona mais um na variavel cont
    //troca o valor de um input invisivel para o numero de vezes que a function rodou
    document.getElementById("aqui2").value = cont;
    console.log(cont);
}
var contm = 0;
function addLabelM() {
    document.getElementById("aqlb").innerHTML+="<input class='form-control' size='10' type='text' id='material"+contm+"' name='material"+contm+"' placeholder='Insira o material'>" +
        "<input class='form-control' type='number' size='2' step='any' id='quant"+contm+"' name='quant"+contm+"' placeholder='Insira a quantidade'><br>";
    contm++; //adiciona mais um na variavel cont
    //troca o valor de um input invisivel para o numero de vezes que a function rodou
    document.getElementById("aqlb2").value = contm;
    console.log(contm);
    teste = parseFloat(document.getElementById('aqlb2').value, 10);
    console.log(teste);
}
