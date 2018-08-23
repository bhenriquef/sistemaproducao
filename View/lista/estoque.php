<?php
$posi = "lista";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
$i = $_GET['i'];
$itenspagina = 10; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual

$resultado = "select t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, 
              t.valor_tecido, c.nome_cor, x.quantidade_tcor, x.qtdusada_tcor
              from tecido t, cor c, tecido_cor x
              where t.id_tecido = x.tecido_id and c.id_cor = x.cor_id
              ORDER by t.id_tecido ASC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$tecido = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, 
                                                t.valor_tecido, c.nome_cor, x.quantidade_tcor, x.qtdusada_tcor
                                                from tecido t, cor c, tecido_cor x
                                                where t.id_tecido = x.tecido_id and c.id_cor = x.cor_id;")->num_rows;
//sql para puxar o total de produtos


$num_paginas = ceil($num_total/$itenspagina); //numero de paginas

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{

    ?>
    <h1 class="text-center">Estoque Tecidos</h1>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10"><form>
                <?php

                if($num > 0){
                    echo "<div class=\"table-responsive\">
                            <table class='table table-bordered table-hover'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>Descrição</th>
                                        <th scope='col'>Composição</th>
                                        <th scope='col'>Fornecedor</th>
                                        <th scope='col'>Valor</th>
                                        <th scope='col'>Cor</th>
                                        <th scope='col'>Quantidade Atual</th>
                                        <th scope='col'>Quantidade Gasta</th>
                                        <th scope='col'>Quantidade Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                              ";
                        if($tecido['nome_tecido'] != "Nenhum"){
                            echo "
                                <tr>
                                    <td>".$tecido['nome_tecido']."</td>
                                    <td>".$tecido['composicao_tecido']."</td>
                                    <td>".$tecido['fornecedor_tecido']."</td>
                                    <td>".$tecido['valor_tecido']."</td>
                                    <td>".$tecido['nome_cor']."</td>
                                    <td>".$tecido['quantidade_tcor']."</td>
                                    <td>".$tecido['qtdusada_tcor']."</td>
                                    <td>".($tecido['quantidade_tcor'] + $tecido['qtdusada_tcor'])."</td>
                                </tr>
                                ";
                        }
                        while ($tecido = $execute->fetch_assoc()){
                            echo "
                                <tr>
                                    <td>".$tecido['nome_tecido']."</td>
                                    <td>".$tecido['composicao_tecido']."</td>
                                    <td>".$tecido['fornecedor_tecido']."</td>
                                    <td>".$tecido['valor_tecido']."</td>
                                    <td>".$tecido['nome_cor']."</td>
                                    <td>".$tecido['quantidade_tcor']."</td>
                                    <td>".$tecido['qtdusada_tcor']."</td>
                                    <td>".($tecido['quantidade_tcor'] + $tecido['qtdusada_tcor'])."</td>
                                </tr>
                                ";
                    }
                    echo "</tbody></table></div>";
                }
                else{
                    echo "<h2>Não tem nenhuma peça nessa coleção</h2>";
                }
                ?>

                </form>
            </div>
        </div>
    </div>
    <br>
    <form action="estoque.php" method="GET">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='estoque.php?pagina=0&i=0&id=$colecao'><span aria-hidden='true'>&laquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='estoque.php?pagina=".($pagina-10)."&i=".($i-1)."&id=$colecao'> < </a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><</a></li>";
                    }
                    ?>

                </li>
                <li class="page-item active">
                    <a class="page-link"><?php echo $i+1 ?></a>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+10 < $num_total){
                        echo "<a class='page-link' href='estoque.php?pagina=".($pagina+10)."&i=".($i+1)."&id=$colecao'>></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+10 < $num_total){
                        echo "<a class='page-link' href='estoque.php?pagina=".(($num_paginas-1)*10)."&i=".($num_paginas-1)."&id=$colecao'><span aria-hidden='true'>&raquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&raquo</span></a></li>";
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </form>
    <?php
}
?>