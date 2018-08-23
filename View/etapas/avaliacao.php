<?php
$posi = "etapas";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
cdstavaliacao();
$i = $_GET['i'];
$itenspagina = 1; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual


$resultado = "select p.nome_peca, p.composicao_peca, p.referencia_peca, p.data_peca, g.tamanhop_grade,
                                    g.tamanhom_grade, g.tamanhog_grade, t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, p.id_peca, e.nome_etapa
                                    from peca p, grade g, tecido t, etapa e
                                    where p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and t.id_tecido = p.tecido_id
                                    and e.id_etapa = '2'
                                    ORDER by p.id_peca DESC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$peca = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select p.nome_peca, p.composicao_peca, p.referencia_peca, p.data_peca, g.tamanhop_grade,
                                    g.tamanhom_grade, g.tamanhog_grade, t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, p.id_peca, e.nome_etapa
                                    from peca p, grade g, tecido t, etapa e
                                    where p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and t.id_tecido = p.tecido_id
                                    and e.id_etapa = '2'")->num_rows;
//sql para puxar o total de produtos


$num_paginas = ceil($num_total/$itenspagina); //numero de paginas

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{    ?>
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                $data = date_create($peca['data_peca']);
                if($num > 0){
                    echo "
                        <div class=\"container\">
                          <div class=\"card-deck mb-3 text-center\">
                            <div class=\"card mb-4 shadow-sm\">
                              <div class=\"card-header\">
                                <h2 class=\"my-0 font-weight-normal\">Descrição: ".$peca['nome_peca']." - Referencia: ".$peca['referencia_peca']." - Data: ".date_format($data,'d/m/y')."</h2>
                              </div>
                              <div class=\"card-body\">
                                <h4 class=\"card-title pricing-card-title\">Tecido: ".$peca['nome_tecido']." - Composição: ".$peca['composicao_peca']." - Fornecedor: ".$peca['fornecedor_tecido']."<small class=\"text-muted\"></small></h4>
                                <ul class=\"list-unstyled mt-3 mb-4\">
                                    <li><b>Cores: </b></li><li>";
                    $resposta = impCor($peca['id_peca']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($cor = $resposta->fetch_assoc()){
                        echo " ".$cor['nome_cor']." , ";
                    }
                    echo "</li>
                                  <li><b>Composição da peça: </b></li><li>".$peca['composicao_peca']."</li>
                                  <li><b>Grade:</b></li>
                                  <li><b>P: </b>".$peca['tamanhop_grade']."<b> M: </b>".$peca['tamanhom_grade']."<b>  G: </b>".$peca['tamanhog_grade']."</li>
                                  <li><b>Desenho Tecnico</b></li>";
                    $resposta = impFotoPeca($peca['id_peca']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($foto = $resposta->fetch_assoc()){
                        echo "<input class='img-thumbnail rounded' data-toggle=\"modal\" data-target=\"#mimagem\" onclick='exibirImagem(this.id)' id='".$foto['nome_foto']."' class='img-thumbnail rounded' alt='Imagem Ilustrativa' type='image' style='width: 100%;max-width: 250px' src='../../imagens/".$foto['nome_foto']."'>";
                    }
                    echo "</ul>
                       <label>Comentario</label>
                        <form method='POST' action=''> 
                           <input type='text' hidden value='".$peca['id_peca']."' name='idpeca' id='idpeca'>
                           <textarea class='form-control' cols='29' rows='5' name='comentario' id='comentario'></textarea>
                           <br><input class='form-control btn btn-outline-success' type='submit' id='btnaprovar' name='btnaprovar' value='Aprovar Modelo'>
                           <input class='form-control btn btn-outline-danger' type='submit' id='btnrecusar' name='btnrecusar' value='Recusar Modelo'>
                        </form>
                      </div>
                   </div>
                </div>";
                }
                else{
                    echo "<h2 class='text-center'>Não tem nada para ser avaliado</h2>";
                }

                ?>
            </div>
        </div>
    </div>

    <form action="avaliacao.php" method="GET">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='avaliacao.php?pagina=0&i=0'><span aria-hidden='true'>&laquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='avaliacao.php?pagina=".($pagina-1)."&i=".($i-1)."'> < </a>";
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
                    if($pagina+1 < $num_total){
                        echo "<a class='page-link' href='avaliacao.php?pagina=".($pagina+1)."&i=".($i+1)."'>></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+1 < $num_total){
                        echo "<a class='page-link' href='avaliacao.php?pagina=".(($num_paginas-1)*1)."&i=".($num_paginas-1)."'><span aria-hidden='true'>&raquo</span></a>";
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