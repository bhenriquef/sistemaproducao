<?php
session_start();
require_once('conectar.php'); //conecta no banco de dados
require_once('config.php'); //configuraçao do banco de dados

function login(){
    if(isset($_POST['btnlogar'])) { //confete se o botao de login foi apertado
        $con = conectar(); //faz a conecçao com o banco
        $resultado = $con->query("select * from usuario where nome_usuario = '" . $_POST['txtlogin'] . "' and senha_usuario ='" . $_POST['txtsenha'] . "';");
        //linha sql para comparar se o login que foi posto existe no banco
        $login = mysqli_fetch_object($resultado); //pega o que voltou do sql e armazena na variavel login
        if ($resultado->num_rows == 0) { //confere se a linha sql retornou algum resultado, se nao tiver retornado entra no if
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                    Login ou Senha incorretos!!!
                  </div>"; //emite um msg dizendo que o login ou senha esta errado
        } else { // se tiver retornado entra no else
            $_SESSION['login'] = $login->id_usuario; //pega o ID do usuario e armazena em uma variavel
            header('Location: View/colecao/lista.php?i=0&pagina=0'); //redireciona o usuario para a tela de cadastro de produtos
        }
    }
}
?>