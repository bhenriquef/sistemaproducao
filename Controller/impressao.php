<?php
require_once('conectar.php');
require_once('config.php');

function impColecao(){
    $con = conectar();
    $sql = "select * from colecao order by id_colecao ASC";
    $resultado = $con->query($sql);
    return $resultado;
    desconectar($con);
}

function impTecido(){
    $con = conectar();
    $resultado = $con->query("select * from tecido ORDER  by id_tecido ASC ");
    desconectar($con);
    return $resultado;
}

function impTecidoVal($id){
    $con = conectar();
    $resultado = $con->query("select valor_tecido from tecido t where t.id_tecido = '" . $id . "'");
    desconectar($con);
    return $resultado;
}

function impPecas($etapa){
    $con = conectar();
    $resultado = $con->query("select p.nome_peca, p.composicao_peca, p.referencia_peca, p.data_peca, g.tamanhop_grade,
                                    g.tamanhom_grade, g.tamanhog_grade, t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, p.id_peca, e.nome_etapa
                                    from peca p, grade g, tecido t, etapa e
                                    where p.id_peca = g.peca_id and p.etapa_id = e.id_etapa
                                    and e.id_etapa = '".$etapa."'") or die(mysqli_error($con->error));
    desconectar($con);
    return $resultado;
}

function impFotoPeca($peca){
    $con = conectar();
    $resultado = $con->query("select f.nome_foto from foto f, peca p where
                                     p.id_peca = f.peca_id and p.id_peca = '" . $peca . "'");
    desconectar($con);
    return $resultado;
}

function impCor($peca){
  $con = conectar();
  $resultado = $con->query("select nome_cor from cor c, peca p, tecido_cor t 
                                  where p.tecido_id = t.tecido_id and t.cor_id = c.id_cor and p.id_peca = '".$peca."'");
    desconectar($con);
    return $resultado;
}

function impComentario($peca){
    $con = conectar();
    $resultado = $con->query("select comentario from avaliacao a, peca p
                                     where p.id_peca = a.peca_id and p.id_peca = '".$peca."'");
    desconectar($con);
    return $resultado;
}

function impMaterial($peca){
    $con = conectar();
    $resultado = $con->query("select id_modelagem, nome_material, quantidade_material from modelagem
                                     where peca_id = '$peca'");
    desconectar($con);
    return $resultado;
}

function impFuncionario($tipo){
    $con = conectar();
    $resultado = $con->query("select id_usuario, nome_usuario from usuario where tipo_id ='".$tipo."'");
    desconectar($con);
    return $resultado;
}

function impTipoF(){
    $con = conectar();
    $resultado = $con->query("select id_tipo, nome_tipo from tipo_usuario;");
    desconectar($con);
    return $resultado;
}

function impResponsavelCorte($id){
    $con = conectar();
    $resultado = $con->query("select u.id_usuario ,u.nome_usuario, c.data_entrada, c.data_saida from corte c, usuario u 
                                     where c.responsavel_corte = u.id_usuario and peca_id= '".$id."'");
    desconectar($con);
    return $resultado;
}

function impResponsavelCostura($id){
    $con = conectar();
    $resultado = $con->query("select u.id_usuario ,u.nome_usuario, c.data_entrada, c.data_saida from costura c, usuario u 
                                     where c.responsavel_costura = u.id_usuario and peca_id= '".$id."'");
    desconectar($con);
    return $resultado;
}

function impPagamento($id){
    $con = conectar();
    $resultado = $con->query("select pg.valor, pg.data_pag, p.nome_peca, p.qtd_peca, pg.id_pagamento
                                    from peca p, pagamento pg
                                    where p.id_peca = pg.peca_id and funcionario_id = '".$id."';");
    desconectar($con);
    return $resultado;
}

function impbtncolecao($id){
    if($id == '1'){
        echo "<input type='submit' disabled class='form-control btn btn-outline-success' name='btnprincipal' id='btnprincipal' value='Atual'>
              <input type='submit' class='form-control btn btn-outline-danger' name='btnconcluir' id='btnconcluir' value='Concluir'>";
    }
    else if($id == '2'){
        echo "
              <input type='submit' disabled class='form-control btn btn-outline-danger' name='btnconcluir' id='btnconcluir' value='Concluido'>";
    }
    else{
        echo "<input type='submit' class='form-control btn btn-outline-success' name='btnprincipal' id='btnprincipal' value='Atual?'>
              <input type='submit' class='form-control btn btn-outline-danger' name='btnconcluir' id='btnconcluir' value='Concluir'>";
    }
}

function impProgress ($valprog){
    $valprog *= 16.66;
    if($valprog < 20){
        $cor = 'bg-danger';
    }
    else if($valprog > 19 and $valprog < 40){
        $cor = 'bg-warning';
    }
    else if($valprog > 39 and $valprog < 60){
        $cor = 'bg-info';
    }
    else if($valprog > 59 and $valprog < 80){
        $cor = '';
    }
    else{
        $cor = 'bg-success';
    }

    echo "<div class='progress'><div class=\"progress-bar progress-bar-striped progress-bar-animated ".$cor."\" role=\"progressbar\" style=\"width: ".$valprog."%\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div></div>";
}


?>