<?php
$posi = "index";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');

$i = $_GET['i'];
$itenspagina = 5; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual

$resultado = "select p.nome_peca, p.referencia_peca, p.data_peca, t.nome_tecido, e.nome_etapa, e.id_etapa, x.nome_colecao, p.id_peca
                                    from peca p, grade g, tecido t, colecao x, etapa e
                                    where x.id_colecao = p.colecao_id and p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and p.tecido_id = t.id_tecido
                                    and x.ecolecao_id = 1
                                    ORDER by p.id_peca DESC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$peca = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select p.nome_peca, p.referencia_peca, p.data_peca, t.nome_tecido, e.nome_etapa, e.id_etapa, x.nome_colecao, p.id_peca
                                    from peca p, grade g, tecido t, colecao x, etapa e
                                    where x.id_colecao = p.colecao_id and p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and p.tecido_id = t.id_tecido
                                    and x.ecolecao_id = 1")->num_rows;
//sql para puxar o total de produtos


$num_paginas = ceil($num_total/$itenspagina); //numero de paginas

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{

    ?>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
             echo " <h1 class=\"text-center\">".$peca['nome_colecao']."</h1>";
                $data = date_create($peca['data_peca']);
                if($num > 0){
                    echo "  <div class=\"container\">
                          <div class=\"card-deck mb-3 text-center\">
                            <div class=\"card mb-4 shadow-sm\">
                              <div class=\"card-header\">
                              <div class='row justify-content-center align-items-center'>
                                    <div class='col-lg-4 border-right'>
                                        <h3 class=\"card-title pricing-card-title\">Etapa: ".$peca['nome_etapa']."<small class=\"text-muted\"></small></h3>
                                    </div>
                                    <div class='col-lg-6'>";
                                        impProgress($peca['id_etapa']);
                               echo"</div>
                                </div>
                                
                              </div>
                              <div class=\"card-body\">
                                <h3 class=\"my-0 font-weight-normal\"><b>Descrição: </b>".$peca['nome_peca']." - <b>Referencia: </b>".$peca['referencia_peca']."</h3>
                                <ul class=\"list-unstyled mt-3 mb-4\">
                                    <h5><b>Data: </b>".date_format($data,'d/m/Y')."</h5>
                                    <h5><b>Tecido: </b>".$peca['nome_tecido']."</h5>
                                    <h5><b>Cores: </b>";
                    $resposta = impCor($peca['id_peca']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($cor = $resposta->fetch_assoc()){
                        echo " ".$cor['nome_cor']." , ";
                    }
                    echo "</h5>
                                  <h5><b>Desenho Tecnico</b></h5>";
                    $resposta = impFotoPeca($peca['id_peca']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($foto = $resposta->fetch_assoc()){
                        echo "<input data-toggle=\"modal\" data-target=\"#mimagem\" onclick='exibirImagem(this.id)' id='".$foto['nome_foto']."' class='img-thumbnail rounded' alt='Imagem Ilustrativa' type='image' style='width: 100%;max-width: 250px' src='../../imagens/".$foto['nome_foto']."'>";
                    }
                    echo "</ul>
                        <form method='POST' action=''> 
                        </form>
                      </div>
                   </div>
                </div>";

                    //REPETIÇAO

                    while ($peca = $execute->fetch_assoc()){
                        echo "  <div class=\"container\">
                          <div class=\"card-deck mb-3 text-center\">
                            <div class=\"card mb-4 shadow-sm\">
                              <div class=\"card-header\">
                              <div class='row justify-content-center align-items-center'>
                                    <div class='col-lg-4 border-right'>
                                        <h3 class=\"card-title pricing-card-title\">Etapa: ".$peca['nome_etapa']."<small class=\"text-muted\"></small></h3>
                                    </div>
                                    <div class='col-lg-6'>";
                        impProgress($peca['id_etapa']);
                        echo"</div>
                                </div>
                                
                              </div>
                              <div class=\"card-body\">
                                <h3 class=\"my-0 font-weight-normal\"><b>Descrição: </b>".$peca['nome_peca']." - <b>Referencia: </b>".$peca['referencia_peca']."</h3>
                                <ul class=\"list-unstyled mt-3 mb-4\">
                                    <h5><b>Data: </b>".date_format($data,'d/m/Y')."</h5>
                                    <h5><b>Tecido: </b>".$peca['nome_tecido']."</h5>
                                    <h5><b>Cores: </b>";
                        $resposta = impCor($peca['id_peca']);
                        //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                        while ($cor = $resposta->fetch_assoc()){
                            echo " ".$cor['nome_cor']." , ";
                        }
                        echo "</h5>
                                  <h5><b>Desenho Tecnico</b></h5>";
                        $resposta = impFotoPeca($peca['id_peca']);
                        //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                        while ($foto = $resposta->fetch_assoc()){
                            echo "<input data-toggle=\"modal\" data-target=\"#mimagem\" onclick='exibirImagem(this.id)' id='".$foto['nome_foto']."' class='img-thumbnail rounded' alt='Imagem Ilustrativa' type='image' style='width: 100%;max-width: 250px' src='../../imagens/".$foto['nome_foto']."'>";
                        }
                        echo "</ul>
                        <form method='POST' action=''> 
                        </form>
                      </div>
                   </div>
                </div>";
                    }
                }
                else{
                    echo "<h2 class='text-center'>Não tem nenhuma peça nessa coleção</h2>";
                }

                ?>
            </div>
        </div>
    </div>
    <form action="pecas.php" method="GET">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='pecas.php?pagina=0&i=0&id=".$_GET['id']."'><span aria-hidden='true'>&laquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='pecas.php?pagina=".($pagina-5)."&i=".($i-1)."&id=".$_GET['id']."'> < </a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><</a></li>";
                    }
                    ?>

                </li>
                <li class="page-item active">
                    <a class='page-link'><?php echo $i+1 ?></a>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+5 < $num_total){
                        echo "<a class='page-link' href='pecas.php?pagina=".($pagina+5)."&i=".($i+1)."&id=".$_GET['id']."'>></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+5 < $num_total){
                        echo "<a class='page-link' href='pecas.php?pagina=".(($num_paginas-1)*5)."&i=".($num_paginas-1)."&id=".$_GET['id']."'><span aria-hidden='true'>&raquo</span></a>";
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