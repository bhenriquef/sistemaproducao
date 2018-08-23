<?php
$posi = "colecao";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
etapaColecao();

$i = $_GET['i'];
$itenspagina = 10; //numero de itens por pagina;
$pagina = intval($_GET['pagina']); //pagina atual

$sqlcod = "select id_colecao,nome_colecao,ecolecao_id from colecao ORDER by id_colecao DESC LIMIT $pagina, $itenspagina "; //sql para limitar os produtos por requisiçao
$execute = $con->query($sqlcod) or die($con->error);
$colecaof = $execute->fetch_assoc();
$num = $execute->num_rows;

$num_total = $con->query("select id_colecao,nome_colecao,ecolecao_id from colecao")->num_rows; //sql para puxar o total de produtos

$num_paginas = ceil($num_total/$itenspagina); //numero de paginas
if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}

else //se estiver logado permite ver a tela
{

?>


<br>
    <h1 class="text-center">Coleções</h1>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                if($num > 0){
                    echo "<form method='POST' action=''>
                           <div class=\"input-group mb-3\">   
                             <div class='input-group-prepend' id=\"final\">
                               <a href='pecas.php?pagina=0&i=0&id=".$colecaof['id_colecao']."' class='form-control btn btn-outline-primary'>Peças</a>
                             </div>                            
                             <input type=\"text\" class=\"form-control text-center\" disabled placeholder='".$colecaof['nome_colecao']."' aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                             <div class=\"input-group-append\" id=\"começo\">";
                               impbtncolecao($colecaof['ecolecao_id']);
                               echo "
                               <input hidden type='text' value='".$colecaof['id_colecao']."' id='idcolecao' name='idcolecao'>
                             </div> 
                           </div>
                          </form>";
                    while ($colecaof = $execute->fetch_assoc()){
                        echo "<form method='POST' action=''>
                                   <div class=\"input-group mb-3\">   
                                      <div class='input-group-prepend' id=\"final\">
                                       <a href='pecas.php?pagina=0&i=0&id=".$colecaof['id_colecao']."' class='form-control btn btn-outline-primary'>Peças</a>
                                      </div>                            
                                      <input type=\"text\" class=\"form-control text-center\" disabled placeholder='".$colecaof['nome_colecao']."' aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                                      <div class=\"input-group-append\" id=\"começo\">";
                                        impbtncolecao($colecaof['ecolecao_id']);
                                        echo "
                                           <input hidden type='text' value='".$colecaof['id_colecao']."' id='idcolecao' name='idcolecao'>
                                      </div> 
                                   </div>
                              </form>";
                    }
                }
                else{
                    echo "<h2>Não a nenhuma coleção</h2>";
                }
                ?>
            </div>
        </div>
    </div>

    <form action="lista.php" method="GET">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <?php
                        if($pagina != 0){
                            echo "<a class='page-link' href='lista.php?pagina=0&i=0'><span aria-hidden='true'>&laquo</span></a>";
                        }
                        else{
                            echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&laquo</span></a></li>";
                        }
                        ?>
                    </li>
                    <li class="page-item">
                        <?php
                        if($pagina != 0){
                            echo "<a class='page-link' href='lista.php?pagina=".($pagina-10)."&i=".($i-1)."'> < </a>";
                        }
                        else{
                            echo "<li class='page-item disabled'><a class='page-link'><</a></li>";
                        }
                        ?>

                    </li>
                    <li class="page-item active">
                        <a class='page-link'><?php echo $i+1 ?></a>
                    </li>
                    <li class="page-item">
                        <?php
                        if($pagina+10 < $num_total){
                            echo "<a class='page-link' href='lista.php?pagina=".($pagina+10)."&i=".($i+1)."'>></a>";
                        }
                        else{
                            echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'>></a></li>";
                        }
                        ?>
                    </li>
                    <li class="page-item">
                        <?php
                        if($pagina+10 < $num_total){
                            echo "<a class='page-link' href='lista.php?pagina=".(($num_paginas-1)*10)."&i=".($num_paginas-1)."'><span aria-hidden='true'>&raquo</span></a>";
                        }
                        else{
                            echo "<li class='page-item disabled'><a class='page-link' style='color: dimgray'><span aria-hidden='true'>&raquo</span></a></li>";
                        }
                        ?>
                    </li>
                </ul>
            </nav>
    </form>
    </body>
<?php
}
?>