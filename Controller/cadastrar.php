<?php
require_once('conectar.php'); //conectar no banco
require_once('config.php'); //pegar a configuraçao do banco

function cdstmodelagem(){
    $con = conectar();
    if(isset($_POST['btnetapa'])){
        if($_POST['aqlb2'] != 0){
            for ($i = 0;$i < $_POST['aqlb2']; $i++){
                $comandosql = "insert into modelagem(nome_material,quantidade_material,peca_id) 
                           VALUES ('".$_POST['material'.$i]."','".$_POST['quant'.$i]."','".$_POST['idpeca']."');";
                $sql = mysqli_query($con,$comandosql) or die(mysqli_error($con));
            }
            $comandosql = "update peca set etapa_id = '2' where id_peca = '".$_POST['idpeca']."';";
            $sql = mysqli_query($con,$comandosql) or die(mysqli_error($con));
            desconectar($con);
        }
        else{
            $comandosql = "update peca set etapa_id = '2' where id_peca = '".$_POST['idpeca']."';";
            $sql = mysqli_query($con,$comandosql) or die(mysqli_error($con));
            desconectar($con);
        }
    }
}

function cdsttecido()
{
    if (isset($_POST['btntecido'])) { //confere se o botao de cadastro de tecido foi apertado
        $con = conectar();
        $comandosql = "insert into tecido(nome_tecido,composicao_tecido,valor_tecido,fornecedor_tecido) VALUES('" . $_POST['nome_tecido'] . "','" . $_POST['composicao'] . "','" . $_POST['valor'] . "','" . $_POST['fornecedor'] . "');";
        //linha sql para cadastrar o novo tecido no banco
        $sql = mysqli_query($con, $comandosql) or die (mysqli_error($con)); //efetua a linha sql
        $resultado = $con->query("select id_tecido from tecido where nome_tecido = '" . $_POST['nome_tecido'] . "';"); //conesegue o ID do tecido que acaba de ser cadastrado
        $tecido = mysqli_fetch_object($resultado); //recebe o resultado e o colaca na variavel tecido
        for ($i = 0; $i < $_POST['aqui2']; $i++) { //estrutura de repetiçao para cadastrar as cores
            $comandosql = "insert into cor(nome_cor) VALUES('" . $_POST['cor' . $i] . "');"; //linha sql para adicionar as novas cores no banco
            $sql = mysqli_query($con, $comandosql) or die (mysqli_error($con)); //efetua a linha sql
            $resultado1 = $con->query("select id_cor from cor where nome_cor = '" . $_POST['cor' . $i] . "';"); //conesegue o ID do tecido que acaba de ser cadastrado
            $cor = mysqli_fetch_object($resultado1) or die (mysqli_error($con)); //recebe o resultado e o colaca na variavel tecido
            $comandosql = "insert into tecido_cor(cor_id,tecido_id,quantidade_tcor,qtdusada_tcor) VALUES('" . $cor->id_cor . "','" . $tecido->id_tecido . "','" . $_POST['quant' . $i] . "','0');"; //linha sql para adicionar as novas cores no banco
            $sql = mysqli_query($con, $comandosql) or die (mysqli_error($con)); //efetua a linha sql
            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong>Sucesso</strong> Cadastro de tecido feito com sucesso!
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
        }
        desconectar($con);
    }
}

function cdstfunc(){
    if(isset($_POST['enviar'])){
        $con = conectar();
        $nomenovo = strtolower($_POST['nome']);
        $login = "Mdl".$nomenovo;
        $senha = "@Mdl#".$nomenovo;
        $comandosql = "insert into usuario(nome_usuario,login_usuario,senha_usuario,tipo_id,telefone_usuario) 
                   VALUES ('".$_POST['nome']."','".$login."','".$senha."','".$_POST['responsavel']."','".$_POST['telefone']."')";
        $sql = mysqli_query($con, $comandosql) or die(mysqli_error($con));
        desconectar($con);
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong>Sucesso</strong> Cadastro de tecido feito com sucesso!
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
    }
}

function cdstcolecao(){
    if(isset($_POST['btncole'])){
        $con = conectar();
        $comandosql = "insert into colecao(nome_colecao,ecolecao_id) VALUES('".$_POST['nome_colecao']."','0');"; //linha sql para inserir nova coleção no banco
        $sql = mysqli_query($con,$comandosql) or die (mysqli_error($con)); //efetua a linha sql
        desconectar($con);
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong>Sucesso</strong> Cadastro de tecido feito com sucesso!
                      <button type=\"button\" id='aviso' name='aviso' class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
    }
}

function cdstavaliacao(){
    if(isset($_POST['btnaprovar'])){
        $con = conectar();
        $comandosql = "insert into avaliacao(peca_id,comentario) 
                           VALUES ('".$_POST['idpeca']."','".$_POST['comentario']."')";
        $sql = mysqli_query($con,$comandosql);
        $comandosql = "update peca set etapa_id = '3' where id_peca = '".$_POST['idpeca']."';";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
    else if(isset($_POST['btnrecusar'])){
        $con = conectar();
        $comandosql = "delete from peca where id_peca = '".$_POST['idpeca']."'";
        $sql = mysqli_query($con,$comandosql) or die(mysqli_error($con));
        $comandosql = "delete from modelagem where peca_id ='".$_POST['idpeca']."'";
        $sql = mysqli_query($con,$comandosql);
        $comandosql = "delete from grade where peca_id ='".$_POST['idpeca']."'";
        $sql = mysqli_query($con,$comandosql);
        $resultado = $con->query("select * from foto where peca_id ='".$_POST['idpeca']."'");
        $foto = mysqli_fetch_all($resultado);
        foreach($foto as $fotonome ){
            unlink('../imagens/'.$fotonome[1]);
        }
        $comandosql = "delete from foto where peca_id ='".$_POST['idpeca']."'";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
}
function cdstampliacao(){
    if(isset($_POST['btnampliacao'])){
        $con = conectar();
        $comandosql = "insert into ampliacao(peca_id,detalhe) 
                           VALUES ('".$_POST['idpeca']."','".$_POST['comentario']."')";
        $sql = mysqli_query($con,$comandosql);
        $comandosql = "update peca set etapa_id = '4' where id_peca = '".$_POST['idpeca']."';";
        $sql = mysqli_query($con,$comandosql);
        $comandosql = "insert into corte(peca_id,responsavel_corte,data_entrada,data_saida) 
                           VALUES ('".$_POST['idpeca']."','".$_POST['responsavel']."','".$_POST['dataentrada']."','".$_POST['datasaida']."')";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
}

function cdstfimpeca(){
    if(isset($_POST['btnconcluir'])){
        $con = conectar();
        $comandosql = "update peca set etapa_id = '6' where id_peca = '".$_POST['idpeca']."';";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
}
?>