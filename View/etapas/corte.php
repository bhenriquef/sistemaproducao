<?php
$posi = "etapas";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
require_once ('../../Controller/cadastrar_corte.php');
cadstCorte();

$i = $_GET['i'];
$itenspagina = 1; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual


$resultado = "select p.nome_peca, p.composicao_peca, p.referencia_peca, p.data_peca, g.tamanhop_grade,
                                    g.tamanhom_grade, g.tamanhog_grade, t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, p.id_peca, p.forro_id, p.entretela_id, t.id_tecido
                                    from peca p, grade g, tecido t, etapa e
                                    where p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and t.id_tecido = p.tecido_id
                                    and e.id_etapa = '4'
                                    ORDER by p.id_peca DESC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$peca = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select p.nome_peca, p.composicao_peca, p.referencia_peca, p.data_peca, g.tamanhop_grade,
                                    g.tamanhom_grade, g.tamanhog_grade, t.nome_tecido, t.composicao_tecido, t.fornecedor_tecido, p.id_peca, p.forro_id, p.entretela_id, t.id_tecido
                                    from peca p, grade g, tecido t, etapa e
                                    where p.id_peca = g.peca_id and p.etapa_id = e.id_etapa and t.id_tecido = p.tecido_id
                                    and e.id_etapa = '4'")->num_rows; //sql para pegar os valores
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
                if($num > 0){
                    echo "<div class=\"container\">
                          <div class=\"card-deck mb-3 text-center\">
                            <div class=\"card mb-4 shadow-sm\">
                              <div class=\"card-header\">
                                <h2 class=\"my-0 font-weight-normal\">Descrição: ".$peca['nome_peca']." - Referencia: ".$peca['referencia_peca']."</h2>
                              </div>
                              <div class=\"card-body\">
                                <h4 class=\"card-title pricing-card-title\">Tecido: ".$peca['nome_tecido']." - Fornecedor: ".$peca['fornecedor_tecido']."<small class=\"text-muted\"></small></h4>
                                <ul class=\"list-unstyled mt-3 mb-4\">
                                  <li><b>Grade:</b></li>
                                  <li><b>P: </b>".$peca['tamanhop_grade']."<b> M: </b>".$peca['tamanhom_grade']."<b>  G: </b>".$peca['tamanhog_grade']."</li>";
                    $resposta = impResponsavelCorte($peca['id_peca']);
                    $responsavel = $resposta->fetch_assoc();
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($responsavel = $resposta->fetch_assoc()){
                        $dataent = date_create($responsavel['data_entrada']);
                        $datasaida = date_create($responsavel['data_saida']);
                        echo "<li><b>Responsavel: </b><u>".$responsavel['nome_usuario']."</u></li>
                                          <li><b> Data Entrada: </b><u>".date_format($dataent,'d/m/y')."</u></li>
                                          <li><b> Data estimada de saida: </b><u>".date_format($datasaida,'d/m/y')."</u></li>
                                          ";
                    }
                    echo "<li><b>Desenho Tecnico</b></li>";
                    $resposta = impFotoPeca($peca['id_peca']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($foto = $resposta->fetch_assoc()){
                        echo "<input class='img-thumbnail rounded' data-toggle=\"modal\" data-target=\"#mimagem\" onclick='exibirImagem(this.id)' id='".$foto['nome_foto']."' class='img-thumbnail rounded' alt='Imagem Ilustrativa' type='image' style='width: 100%;max-width: 250px' src='../../imagens/".$foto['nome_foto']."'>";
                    }
                    echo "</ul>
                                 <form id='calculart' name='calculart' method='POST' action=''> 
                                    <input hidden type='text' id='idcortador' name='idcortador' value='".$responsavel['id_usuario']."'>
                                    <input type='text' hidden value='".$peca['id_peca']."' name='idpeca' id='idpeca'>
                                    <label><b><u>* Por favor insira 0 se clicar em uma barra de texto que nao vai utilizar </u></b></label><br>
                                    <table class='table table-hover'>
                                        <thead class='thead-light'>
                                            <tr>
                                                <th><b>Grade</b></th>
                                                <th><b>P</b></th>
                                                <th><b>M</b></th>
                                                <th><b>G</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        ";

                    $resposta = impCor($peca['id_peca']); $j = 0;
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($cor = $resposta->fetch_assoc()){
                        echo "<tr>
                                                <th scope='row'>". $cor['nome_cor']."</th>
                                                <td><input value='0' onblur=\"calcular(this.id, 'corp')\" class='form-control' name='tamanhop' id='tamanhop".$j."' step='any' type='number' size='1'></td>
                                                <td><input value='0' onblur=\"calcular(this.id, 'corm')\" class='form-control' name='tamanhom' id='tamanhom".$j."' step='any' type='number' size='1'></td>
                                                <td><input value='0' onblur=\"calcular(this.id, 'corg')\" class='form-control' name='tamanhog' id='tamanhog".$j."' step='any' type='number' size='1'></td>
                                              </tr>";
                        $j++;
                    }
                    echo "</tbody>
                                    </table>";
                    $resposta = impMaterial($peca['id_peca']);
                    if(count($material = $resposta->fetch_assoc()) > 0){
                        echo "<table class='table table-hover'>
                                        <thead class='thead-light'>
                                            <tr>
                                                <th><b>Materiais</b></th>
                                                <th><b>Quantidade</b></th>
                                                <th><b>Valor</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope='row'>". $material['nome_material']."</th>
                                                <th scope='row'>". $material['quantidade_material']."</th>
                                                <td><input value='0' onblur=\"calcular(this.id, 'material')\" class='form-control' name='material0' id='material0' step='any' type='number' size='1'></td>
                                                <input hidden name='idm0' id='idm0' value='".$material['id_modelagem']."'>
                                                <input hidden name='idq0' id='idq0' value='".$material['quantidade_material']."'>
                                              </tr>
                                        ";
                    }
                    $o = 1;
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($material = $resposta->fetch_assoc()){
                        echo "<tr>
                                  <th scope='row'>". $material['nome_material']."</th>
                                  <th scope='row'>". $material['quantidade_material']."</th>
                                  <td><input value='0' onblur=\"calcular(this.id, 'material')\" class='form-control' name='material".$o."' id='material".$o."' step='any' type='number' size='1'></td>
                                  <input hidden name='idq".$o."' id='idq".$o."' value='".$material['quantidade_material']."'>
                                  <input hidden name='idm".$o."' id='idm".$o."' value='".$material['id_modelagem']."'>
                              </tr>";
                        $o++;
                    }
                    echo "</tbody></table>
                                          <div class='col-lg-8'><h3><b>Controle Corte</b></h3></div>
                                          <div class='row'>
                                              <div class='col-lg-4 border-right'>
                                                  <label>Rendimento</label>
                                                  <input value='0' onblur=\"calcular(this.id, 'rendimento')\" class='form-control' name='rendimento' id='rendimento' type='number'>
                                                  <label>Forro</label>
                                                  <input class='form-control' value='0' id='forro' name='forro' onblur=\"calcular(this.id, 'forro')\" step='any'  type='number'>
                                                  <label>Entretela</label>
                                                  <input class='form-control' value='0' id='entretela' name='entretela' onblur=\"calcular(this.id, 'entretela')\" step='any' type='number'>
                                              </div>
                                              <div class='col-lg-4'>
                                                  <label>Cortador</label>
                                                  <input class='form-control' value='0' onblur=\"calcular(this.id, 'cortador')\" name='cortador' id='cortador' type='number' required>
                                                  <label>Costureira</label>
                                                  <input class='form-control' value='0' id='costureira' name='costureira' onblur=\"calcular(this.id, 'costureira')\" step='any' type='number' required>
                                              </div>
                                          </div>
                                          <div class=\"row\">
                                              <div class='col-lg-8'>
                                                   <br><label>Responsavel: </label><select class='form-control' name='respcostura' id='respcostura' required>
                                          ";
                    $resposta = impFuncionario('2');
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($funcionario = $resposta->fetch_assoc()){
                        echo "<option class='form-control' value=".$funcionario['id_usuario']." name=".$funcionario['id_usuario'].">".$funcionario['nome_usuario']."</option>";
                    }
                    echo "</select>
                                                  <label>Data Entrada</label><input class='form-control' type='date' id='dataentrada' name='dataentrada' required>
                                                  <label>Data prevista de saida</label><input class='form-control' type='date' id='datasaida' name='datasaida' required>
                                                  <input hidden name='nummat' id='nummat' value='$o'>
                                                  <input hidden name='quantpeca' id='quantpeca'>
                                                  <input hidden name='valorpeca' id='valorpeca'>
                                                  <input hidden name='idtecido' id='idtecido' value='".$peca['id_tecido']."'>
                                                  <input hidden name='identretela' id='identretela' value='".$peca['entretela_id']."'>
                                                  <input hidden name='idforro' id='idforro' value='".$peca['forro_id']."'>
                                              </div>
                                          </div>
                                    ";
                    $resposta = impTecidoVal($peca['id_tecido']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($tecido = $resposta->fetch_assoc()){
                        echo "<input hidden name='vtecido' value='".$tecido['valor_tecido']."' id='vtecido'>";
                    }
                    $resposta = impTecidoVal($peca['entretela_id']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($tecido = $resposta->fetch_assoc()){
                        echo "<input hidden name='ventretela' value='".$tecido['valor_tecido']."' id='ventretela'>";
                    }
                    $resposta = impTecidoVal($peca['forro_id']);
                    //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                    while ($tecido = $resposta->fetch_assoc()){
                        echo "<input hidden name='vforro' value='".$tecido['valor_tecido']."' id='vforro'>";
                    }
                    echo "<br><div id='resultado'></div>
                                                <div class='row justify-content-center'>
                                                    <div class='col-lg-6'>
                                                        <input class='form-control btn btn-outline-success' type='submit' id='btncorte' name='btncorte' value='Proxima Etapa'>          
                                                    </div>
                                                </div>
                                 </form>
                              </div>
                            </div>
                          </div>";
                }
                else{
                    echo "<h2 class='text-center'>Não tem nada para ser cortado</h2>";
                }
                ?>
            </div>
        </div>
    </div><br>
    <form action="corte.php" method="GET">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='corte.php?pagina=0&i=0'><span aria-hidden='true'>&laquo</span></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina != 0){
                        echo "<a class='page-link' href='corte.php?pagina=".($pagina-1)."&i=".($i-1)."'> < </a>";
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
                        echo "<a class='page-link' href='corte.php?pagina=".($pagina+1)."&i=".($i+1)."'>></a>";
                    }
                    else{
                        echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                    }
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    if($pagina+1 < $num_total){
                        echo "<a class='page-link' href='corte.php?pagina=".(($num_paginas-1)*1)."&i=".($num_paginas-1)."'><span aria-hidden='true'>&raquo</span></a>";
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
