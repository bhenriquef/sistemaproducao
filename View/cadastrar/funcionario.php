<?php
$posi = "cadastrar";
require_once ('../../Model/setar.php');
require_once ('../../Model/header.php');
cdstfunc();
if(!isset($_SESSION['login'])){ //confere se a session de login esta ativa
    header('location: ../index.html'); //redireciona para a tela de login
}
else //se estiver logado permite ver a tela
{
    ?>
<script>
            $(document).ready(function() {
                $('#telefone').mask('(00) 00000-0000', {placeholder: "(xx) xxxxx-xxxx"});
            });
</script>
    <body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Cadastrar Funcionario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Nome Funcionario </label><input class="form-control" id="nome" name="nome" type="text" placeholder="Nome Funcionario" required>
                    <label>Telefone </label><input class="form-control" type="text" id="telefone" name="telefone">
                    <label>Tipo Funcionario </label>
                    <select class="form-control" name='responsavel' id='responsavel' required>
                        <?php
                        $resposta = impTipoF();
                        //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                        while ($funcionario = $resposta->fetch_assoc()){
                            echo "<option class=\"form-control\" value=".$funcionario['id_tipo']." name=" .$funcionario['id_tipo']. ">".$funcionario['nome_tipo']. "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <form action="">
                        <input type="submit" id="enviar" name="enviar" value="Cadastrar" class="btn btn-primary">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


                <form id="cadasttecido" method="POST" action="" >
                    <div class="row justify-content-center align-content-center">
                        <div class="form-group col-md-3">
                            <h2>Cadastrar Funcionario</h2>
                            <label>Nome Funcionario </label><input class="form-control" id="nome" name="nome" type="text" placeholder="Nome Funcionario" required>
                            <label>Telefone </label><input class="form-control" type="text" id="telefone" name="telefone">
                            <label>Tipo Funcionario </label>
                            <select class="form-control" name='responsavel' id='responsavel' required>
                                <?php
                                $resposta = impTipoF();
                                //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                                while ($funcionario = $resposta->fetch_assoc()){
                                    echo "<option class=\"form-control\" value=".$funcionario['id_tipo']." name=" .$funcionario['id_tipo']. ">".$funcionario['nome_tipo']. "</option>";
                                }
                                ?>
                            </select><br><input class="form-control" type="submit" onclick="" value="Cadastrar" id="enviar" name="enviar">
                            <br>
                        </div>

                    </div>
                </form>


    </body>
    <?php
}
?>

