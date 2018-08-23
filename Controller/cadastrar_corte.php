<?php
require_once('conectar.php');
require_once('config.php');
function cadstCorte(){
    if(isset($_POST['btncorte'])){
        $con = conectar();
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $comandosql = "update peca set etapa_id = '5', valor_peca = '".$_POST['valorpeca']."'
                    ,qtd_peca = '".$_POST['quantpeca']."' where id_peca = '".$_POST['idpeca']."'";
        $sql = mysqli_query($con,$comandosql);

        for($i = 0; $i < $_POST['nummat']; $i++){
            $comandosql = "update modelagem set preco_material = '".$_POST['material'.$i]."' 
                       where id_modelagem = '".$_POST['idm'.$i]."'";
            $sql = mysqli_query($con, $comandosql);

            $comandosql = "insert into compras(material_id, etapa_id) VALUES ('".$_POST['idm'.$i]."','7') ";
            $sql = mysqli_query($con, $comandosql);
        }

        $subrendimento = $_POST['rendimento'] * $_POST['quantpeca'];
        $subentretela = $_POST['forro'] * $_POST['quantpeca'];
        $subforro = $_POST['entretela'] * $_POST['quantpeca'];

        $comandosql = "update tecido_cor set quantidade_tcor = quantidade_tcor - '".$subrendimento."',
                   qtdusada_tcor = qtdusada_tcor + '".$subrendimento."'
                   where id_tcor = '".$_POST['idtecido']."'";
        $sql = mysqli_query($con, $comandosql);

        $comandosql = "update tecido_cor set quantidade_tcor = quantidade_tcor - '".$subentretela."',
                   qtdusada_tcor = qtdusada_tcor + '".$subentretela."'
                   where id_tcor = '".$_POST['identretela']."'";
        $sql = mysqli_query($con, $comandosql);

        $comandosql = "update tecido_cor set quantidade_tcor = quantidade_tcor - '".$subforro."'
                   qtdusada_tcor = qtdusada_tcor + '".$subforro."'
                   where id_tcor = '".$_POST['idforro']."'";
        $sql = mysqli_query($con, $comandosql);

        $pagcostureira = $_POST['quantpeca'] * $_POST['costureira'];
        $pagcortador = $_POST['quantpeca'] * $_POST['cortador'];

        $comandosql = "insert into pagamento(funcionario_id,peca_id,data_pag,valor) 
                    VALUES ('".$_POST['respcostura']."','".$_POST['idpeca']."','".$data."','".$pagcostureira."')";
        $sql = mysqli_query($con, $comandosql);

        $comandosql = "insert into pagamento(funcionario_id,peca_id,data_pag,valor) 
                    VALUES ('".$_POST['idcortador']."','".$_POST['idpeca']."','".$data."','".$pagcortador."')";
        $sql = mysqli_query($con, $comandosql);

        $comandosql = "insert into costura(peca_id,responsavel_costura,data_entrada,data_saida) 
                   VALUES ('".$_POST['idpeca']."','".$_POST['respcostura']."','".$_POST['dataentrada']."','".$_POST['datasaida']."')";
        $sql = mysqli_query($con, $comandosql);

        $comandosql = "insert into impressao(peca_id, funcionario_id, etapa_id) VALUES ('".$_POST['idpeca']."','".$_POST['respcostura']."','5')";
        $sql = mysqli_query($con, $comandosql);
        desconectar($con);
    }
}

?>