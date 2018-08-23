<?php
require_once('conectar.php');
require_once('config.php');

function cadstPeca()
{
    if (isset($_POST['btnenv'])) {
        $con = conectar();
        $data = date('Y-m-d');

        $comandosql = "insert into peca(nome_peca,data_peca,colecao_id,tecido_id,composicao_peca,referencia_peca,etapa_id,forro_id,entretela_id)VALUES ('" . $_POST['nome'] . "','" . $data . "','" . $_POST['colecaoid'] . "','" . $_POST['tecidoid'] . "','" . $_POST['composicao'] . "','" . $_POST['referencia'] . "','1','" . $_POST['forroid'] . "','" . $_POST['entretelaid'] . "');";
        $sql = mysqli_query($con, $comandosql) or die (mysqli_error($con));

        $resultado = $con->query("select id_peca from peca where nome_peca = '" . $_POST['nome'] . "';");
        $peca = mysqli_fetch_object($resultado) or die(mysqli_error($con));

        $comandosql = "insert into grade(tamanhop_grade,tamanhom_grade,tamanhog_grade,peca_id) VALUES ('" . $_POST['p'] . "','" . $_POST['m'] . "','" . $_POST['g'] . "','" . $peca->id_peca . "');";
        $sql = mysqli_query($con, $comandosql) or die(mysqli_error($con));

        $i = 0;

        while ($i < count($_FILES['imagem']['name'])) {
            if (isset($_POST['btnenv'])) {

                $filename = $_FILES['imagem']['name'][$i];
                $filetmpname = $_FILES['imagem']['tmp_name'][$i];
                $filesize = $_FILES['imagem']['size'][$i];
                $fileerror = $_FILES['imagem']['error'][$i];
                $filetype = $_FILES['imagem']['type'][$i];

                $fileExt = explode('.', $filename);
                $fileAtualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($fileAtualExt, $allowed)) {
                    if ($fileerror === 0) {
                        if ($filesize < 10000000) {
                            $fileNameNovo = uniqid('', true) . "." . $fileAtualExt;
                            $filedestino = '../../imagens/' . $fileNameNovo;
                            move_uploaded_file($filetmpname, $filedestino);
                            $comandosql = "insert into foto(nome_foto,peca_id )VALUES ('" . $fileNameNovo . "','" . $peca->id_peca . "');";
                            $sql = mysqli_query($con, $comandosql) or die (mysqli_error($con));
                            $i++;
                        } else {
                            echo "A imagem é muito grande";
                            break;
                        }
                    } else {
                        echo "Erro ao upar a imagem";
                        break;
                    }
                } else {
                    echo "A imagem nao esta em um formato valido";
                    break;
                }
            }
        }
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong>Sucesso</strong> Cadastro de tecido feito com sucesso!
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
    }
}

?>