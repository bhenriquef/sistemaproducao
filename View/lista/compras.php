<?php
$posi = "lista";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
compras();
$i = $_GET['i'];
$itenspagina = 5; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual


$resultado = "select m.nome_material, m.quantidade_material, m.preco_material, p.nome_peca, p.referencia_peca, c.id_compras
              from peca p, modelagem m, compras c 
              where c.material_id = m.id_modelagem and m.peca_id = p.id_peca
              ORDER by m.id_modelagem DESC LIMIT $pagina, $itenspagina"; //sql para limitar os produtos por requisiçao
$execute = $con->query($resultado) or die($con->error);
$compra = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $resultado = $con->query("select m.nome_material, m.quantidade_material, m.preco_material, p.nome_peca, p.referencia_peca, c.id_compras
                                              from peca p, modelagem m, compras c 
                                              where c.material_id = m.id_modelagem and m.peca_id = p.id_peca;")->num_rows;
//sql para puxar o total de produtos


$num_paginas = ceil($num_total/$itenspagina); //numero de paginas

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{

    ?>
    <br>
    <h1 class="text-center">Compra De Materiais</h1>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                if($num > 0) {
                    echo "<div class='table - responsive'>
                            <table class='table table-bordered table-hover'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>Material</th>
                                        <th scope='col'>Quantidade</th>
                                        <th scope='col'>Preço</th>
                                        <th scope='col'>Peca</th>
                                        <th scope='col'>Referencia</th>
                                        <th scope='col'>Comprar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>" . $compra['nome_material'] . "</td>
                                    <td>" . $compra['quantidade_material'] . "</td>
                                    <td>" . $compra['preco_material'] . "</td>
                                    <td>" . $compra['nome_peca'] . "</td>
                                    <td>" . $compra['referencia_peca'] . "</td>
                                    <td><input class='form-control btn btn-outline-success' type='submit' value='Comprar' id='btncomprar' name='btncomprar'></td>
                                    <td><input hidden id='idpag' name='idpag' type='text' value='" . $compra['id_compras'] . "'></td>
                                </tr>
                              ";

                    while ($compra = $execute->fetch_assoc()) {
                        echo "
                                <tr>
                                    <td>" . $compra['nome_material'] . "</td>
                                    <td>" . $compra['quantidade_material'] . "</td>
                                    <td>" . $compra['preco_material'] . "</td>
                                    <td>" . $compra['nome_peca'] . "</td>
                                    <td>" . $compra['referencia_peca'] . "</td>
                                    <td><input class='form-control btn btn-outline-success' type='submit' value='Comprar' id='btncomprar' name='btncomprar'></td>
                                    <td><input hidden id='idpag' name='idpag' type='text' value='" . $compra['id_compras'] . "'></td>
                                </tr>
                        ";
                    }
                }
                else{
                    echo "<h3 class='text-center'>Nenhum Material a comprar</h3>";
                }

                ?>
                
            </div>
        </div>
    </div>
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