<?php
$posi = "lista";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
pagamento();

$i = $_GET['i'];
$itenspagina = 5; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual



$resultado = "select u.nome_usuario, t.nome_tipo, u.telefone_usuario, u.id_usuario
              from usuario u, tipo_usuario t
              where u.tipo_id = t.id_tipo and u.tipo_id != 1
              ORDER by u.id_usuario DESC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$funcionario = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select u.nome_usuario, t.nome_tipo, u.telefone_usuario, u.id_usuario
                                              from usuario u, tipo_usuario t
                                              where u.tipo_id = t.id_tipo and u.tipo_id != 1")->num_rows;
//sql para puxar o total de produtos


$num_paginas = ceil($num_total/$itenspagina); //numero de paginas

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{

    ?>
    <br>
    <h1 class="text-center">Pagamento de funcionarios</h1>

                <?php
                if($num > 0){
                    echo "<div class=\"container\">
                            <div class=\"card-deck mb-3 text-center\">
                                <div class=\"card mb-4 shadow-sm\">
                                    <div class=\"card-header\">
                                        <h4 class=\"my-0 font-weight-normal\">Nome: ".$funcionario['nome_usuario']." - Função: ".$funcionario['nome_tipo']."</h4>
                                    </div>";
                    $totalpg = 0;
                    $resposta = impPagamento($funcionario['id_usuario']);
                    while ($pagamento = $resposta->fetch_assoc()){
                        $totalpg += $pagamento['valor'];
                        $data = date_create($pagamento['data_pag']);
                        echo "<form class='border' method='post' action=''>
                                                <div class=\"card-body\">
                                                    <h1 class=\"card-title pricing-card-title\">R$".$pagamento['valor']." </h1>
                                                    <ul class=\"list-unstyled mt-3 mb-4\">
                                                        <li>Peça: ".$pagamento['nome_peca']."</li>
                                                        <li>Quantidade: ".$pagamento['qtd_peca']."</li>
                                                        <li>Data: ".date_format($data, 'd/m/y')."</li><br>
                                                        <div class='row justify-content-center'><div class='col-lg-4'><input type='submit' class='form-control btn btn-outline-success' name='btnpagar'></div></div>
                                                        <input hidden type='text' id='idpag' name='idpag' value='".$pagamento['id_pagamento']."'>
                                                    </ul>
                                                </div>
                                            </form>";
                    }
                    echo "<h4 class=\"my-0 font-weight-normal\">Total: ".$totalpg."</h4>
                                </div>
                            </div>";

                    //REPETIÇAO

                    while ($funcionario = $execute->fetch_assoc()){
                        echo "<div class=\"container\">
                            <div class=\"card-deck mb-3 text-center\">
                                <div class=\"card mb-4 shadow-sm\">
                                    <div class=\"card-header\">
                                        <h4 class=\"my-0 font-weight-normal\">Nome: ".$funcionario['nome_usuario']." - Função: ".$funcionario['nome_tipo']."</h4>
                                    </div>";
                                $totalpg = 0;
                                $resposta = impPagamento($funcionario['id_usuario']);
                                 while ($pagamento = $resposta->fetch_assoc()){
                                     $totalpg += $pagamento['valor'];
                                     $data = date_create($pagamento['data_pag']);
                                     echo "<form class='border' method='post' action=''>
                                                <div class=\"card-body\">
                                                    <h1 class=\"card-title pricing-card-title\">R$".$pagamento['valor']." </h1>
                                                    <ul class=\"list-unstyled\">
                                                        <li>Peça: ".$pagamento['nome_peca']."</li>
                                                        <li>Quantidade: ".$pagamento['qtd_peca']."</li>
                                                        <li>Data: ".date_format($data, 'd/m/y')."</li><br>
                                                        <div class='row justify-content-center'><div class='col-lg-4'><input type='submit' class='form-control btn btn-outline-success' value='Pagar' name='btnpagar'></div></div>
                                                        <input hidden type='text' id='idpag' name='idpag' value='".$pagamento['id_pagamento']."'>
                                                    </ul>
                                                </div>
                                            </form>";
                                 }
                                echo "<h3 class=\"my-0 font-weight-normal\">Total: ".$totalpg."</h3>
                                </div>
                            </div>";
                    }

                }

                ?>

    <br>
    <form action="pagamento.php" method="GET">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='pagamento.php?pagina=0&i=0&id=$colecao'><span aria-hidden='true'>&laquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='pagamento.php?pagina=".($pagina-5)."&i=".($i-1)."&id=$colecao'> < </a>";
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
                    if($pagina+5 < $num_total){
                        echo "<a class='page-link' href='pagamento.php?pagina=".($pagina+5)."&i=".($i+1)."&id=$colecao'>></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+5 < $num_total){
                        echo "<a class='page-link' href='pagamento.php?pagina=".(($num_paginas-1)*5)."&i=".($num_paginas-1)."&id=$colecao'><span aria-hidden='true'>&raquo</span></a>";
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