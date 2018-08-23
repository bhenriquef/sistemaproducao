<?php
$posi = 'cadastrar';
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
require_once ('../../Controller/cadastrar_produto.php');
cadstPeca();

if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../teste.html'); //redireciona para a tela de login
}
else //se estiver logado permite ver a tela
{

    ?>

    <h1 class="text-center">Cadastrar Peças</h1>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form id='formulario' enctype='multipart/form-data' method='POST' action=''>
                <table border='0'>
                    <tr>
                        <td><label>Descrição: </label><input class='form-control' name='nome' id='nome' type='text' required></td>
                        <td><label>Coleções </label><select class='form-control' name='colecaoid' id='colecaoid' required>
                                <?php
                                $teste = impColecao();
                                //chama a funçao para imprimir as coleçoes em um <option> (/Controller/impressao.php)
                                while ($colecao = $teste->fetch_assoc())
                                {
                                    echo "<option class='form-control' value=".$colecao['id_colecao']." name=" .$colecao['id_colecao']. ">".$colecao['nome_colecao']. "</option>";
                                }
                                ?>
                            </select></td>
                        <td><label> Tecidos </label><select class='form-control' name='tecidoid' id='tecidoid'  required>
                                <?php
                                $teste1 = impTecido();
                                //chama a function para imprimir os tecidos em um <option> (/Controller/impressao.php)
                                while ($tecido = $teste1->fetch_assoc()){
                                    if($tecido['id_tecido'] != 1){
                                        echo "<option class='form-control' value=".$tecido['id_tecido']." name=" .$tecido['id_tecido']. ">".$tecido['nome_tecido']."</option>";
                                    }
                                }
                                ?>
                            </select></td>
                        <td>Grade:</td>
                        <td><label>P:</label><input class='form-control' size='1' class='campo_nome' name='p' id='p' type='text' required></td>
                        <td> <label>M:</label><input class='form-control' size='1' class='campo_nome' name='m' id='m' type='text' required></td>
                        <td><label>G:</label><input class='form-control' size='1' class='campo_nome' name='g' id='g' type='text' required></td>
                    </tr>
                    <tr>
                        <td><label>Referencia:</label><input class='form-control' class='campo_nome' name='referencia' id='referencia' type='text' required></td>

                        <td><label>Forro </label><select class='form-control' name='forroid' id='forroid'  required>
                                <?php
                                $teste1 = impTecido();
                                //chama a function para imprimir os tecidos em um <option> (/Controller/impressao.php)
                                while ($tecido = $teste1->fetch_assoc()){
                                    echo "<option class='form-control' value=".$tecido['id_tecido']." name=" .$tecido['id_tecido']. ">".$tecido['nome_tecido']. "</option>";
                                }
                                ?>
                            </select></td>
                        <td><label>Entretela </label><select class='form-control' name='entretelaid' id='entretelaid'  required>
                                <?php
                                $teste1 = impTecido();
                                //chama a function para imprimir os tecidos em um <option> (/Controller/impressao.php)
                                while ($tecido = $teste1->fetch_assoc()){
                                    echo "<option class='form-control' value=".$tecido['id_tecido']." name=" .$tecido['id_tecido']. ">".$tecido['nome_tecido']. "</option>";
                                }
                                ?>
                            </select></td>
                        <td><td></td></td>
                    </tr>
                    <tr>
                        <td><label></label></td>
                    </tr>
                    <tr>
                        <td><label>Detalhes:</label><textarea class='form-control' name='composicao' id='composicao' cols='20' rows='3'></textarea><br></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Imagem</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagem[]" name="imagem[]">
                                    <label class="custom-file-label" for="inputGroupFile01">Escolha a Imagem</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="row justify-content-center align-content-center">
                    <div class="col-md-3 form-group">
                        <input class='form-control' name='btnenv' id='btnenv' type='submit' value='Cadastrar'>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php
}
?>