<?php
if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}
else //se estiver logado permite ver a tela
{
    $posi = "cadastrar";
    require_once ('../../Model/setar.php');
    $colecaost = "active";
    require_once ('../../Model/header.php');

?>

<h2>Cadastrar Coleção</h2>
<form id="cadastcolecao" method="POST" action="">
    <fieldset>
        <legend>Coleção</legend>
        <br>
        <label>Nome Coleçao:</label><input class="campo_nome" id="nome_colecao" name="nome_colecao" placeholder="Nome coleção" type="text" required>
        <input class="btn_submit" type="submit" value="Cadastrar" id="btncole" name="btncole">
    </fieldset>
</form>


    <form id="cadasttecido"  method="POST" action="">
        <h2>Cadastrar Tecido</h2>
           <fieldset>
               <legend>Tecido</legend>
               <br>
               <label>Nome Tecido</label><input id="nome_tecido" name="nome_tecido" type="text" placeholder="Nome tecido" required>
               <br><br><label>Composição</label><input id="composicao" name="composicao" type="text" placeholder="Composição" required>
               <br><br><label>Cor -</label>
               <label>Quantidade</label>
               <input type="button" id="btnAdd" name="btnAdd" value="adicionar" onclick="addlabel()">
               <div id="aqui">
               </div>
               <br><label>Fornecedor</label><input id="fonecedor" name="fornecedor" type="text" placeholder="Fornecedor do tecido" required>
               <br><br><label>Valor p/metro</label><input id="valor" name="valor" type="number" placeholder="R$/m" step="any" required>
               <input type="number" id="aqui2" name="aqui2" value="" style="visibility: hidden"><br><br>
               <input class="btn_submit" type="submit" value="Enviar" id="btntecido" name="btntecido">
           </fieldset>
            <br>
    </form>

<?php
}
?>

