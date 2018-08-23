<?php
session_start();
require_once('../../Controller/conectar.php');
require_once('../../Controller/config.php');
require_once('../../Controller/cadastrar.php');
require_once('../../Controller/impressao.php');
require_once('../../Controller/update.php');
require_once('../../Controller/conferir_refresh.php');
$con = conectar();

echo "<head>
    <title>MUNDALUA</title>
    <script type=\"text/javascript\" src=\"".$js."adicionar.js\"></script>
    <script type=\"text/javascript\" src=\"".$js."calcular.js\"></script>
    <script type=\"text/javascript\" src=\"".$js."imagem.js\"></script>
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js\"></script>
    <meta charset=\"utf-8\">
    <link rel=\"stylesheet\" href=\"".$css."/bootstrap.css\">
	<script type='text/javascript' src=\"".$js."/bootstrap.js\"></script>
	<script>
            $(document).ready(function() {
                $('#telefone').mask('(00) 00000-0000', {placeholder: \"(xx) xxxxx-xxxx\"});
            });
</script>
</head>
<body>
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
  <a class=\"navbar-brand\" href=\"#\">MUNDALUA</a>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#Cadastrar\" aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#Producao\" aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#Lista\" aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <div class=\"collapse navbar-collapse\" id=\"navbarNavDropdown\">
    <ul class=\"navbar-nav\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href='$index?i=0&pagina=0'>Home</a>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"Cadastrar\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          Cadastrar
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href='#cdstFuncionario' data-toggle=\"modal\" data-target=\"#cdstFuncionario\">Funcionarios</a>
            <a class=\"dropdown-item\" href='' data-toggle=\"modal\" data-target=\"#cdstcole\">Coleção/Tecido</a>
            <a class=\"dropdown-item\" href=\"".$cadastrar."peca.php\">Peça</a>
        </div>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"Producao\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          Produção
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"".$etapas."modelagem.php?pagina=0&i=0\">Modelagem</a>
            <a class=\"dropdown-item\" href=\"".$etapas."avaliacao.php?pagina=0&i=0\">Avaliação</a>
            <a class=\"dropdown-item\" href=\"".$etapas."ampliacao.php?pagina=0&i=0\">Ampliação</a>
            <a class=\"dropdown-item\" href=\"".$etapas."corte.php?pagina=0&i=0\">Corte</a>
            <a class=\"dropdown-item\" href=\"".$etapas."costura.php?pagina=0&i=0\">Costura</a>
        </div>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"Lista\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          Listas
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"".$lista."compras.php?pagina=0&i=0\">Compras</a>
            <a class=\"dropdown-item\" href=\"".$lista."pagamento.php?pagina=0&i=0\">Pagamentos</a>
            <a class=\"dropdown-item\" href=\"".$lista."estoque.php?pagina=0&i=0\">Estoque</a>
        </div>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\"href=\"".$colecao."lista.php?pagina=0&i=0\">Coleções</a>
      </li>
    </ul>
  </div>
</nav>


<div class=\"modal fade\" id=\"cdstFuncionario\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"cdstFuncionario\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h4 class=\"modal-title\" id=\"cdstFuncionario\">Cadastrar Funcionario</h4>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                 <form method='POST' autocomplete='off' action=''>
                    <label>Nome Funcionario </label><input class=\"form-control\" id=\"nome\" name=\"nome\" type=\"text\" placeholder=\"Nome Funcionario\" required>
                    <label>Telefone </label><input class=\"form-control\" type=\"text\" id=\"telefone\" name=\"telefone\">
                    <label>Tipo Funcionario </label>
                    <select class=\"form-control\" name='responsavel' id='responsavel' required>";
                        $resposta = impTipoF();
                        //chama a function para imprimir os tipos de usuario em um <option> (/Controller/impressao.php)
                        while ($funcionario = $resposta->fetch_assoc()){
                            echo "<option class='form - control' value='".$funcionario['id_tipo']."' name='" .$funcionario['id_tipo']."'>".$funcionario['nome_tipo']."</option>";
                        }
                        echo "
                    </select>
                </div>
                <div class=\"modal-footer\">
                   
                        <input type=\"submit\" id=\"enviar\" name=\"enviar\" value=\"Cadastrar\" class=\"btn btn-primary\">
                        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style='' class=\"modal\" id=\"mimagem\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mimagem\" aria-hidden=\"true\">                                   
                    <button style='' type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span style='color: white; font-size: 80px' class='close' aria-hidden=\"true\">&times;</span>
                    </button>                   
                    <div class='row justify-content-center' style='margin-top: 3%'>               
                        <input class='img-thumbnail rounded' type='image' id='imageModal' src='' style='max-width: 750px;  width: auto\9; height: auto\9; max-height: 600px;'>
                    </div>                    
    </div>
    
    <div class='modal fade' id='cdstcole' tabindex='-1' role='dialog' aria-labelledby='cdstcole' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='cdstcole'>Cadastrar Coleção/Tecido</h4>
                <button  type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <h2>Cadastrar Coleção</h2>
                <form id='cadastcolecao' autocomplete='off' method='POST' action=''>
                        <label>Nome Coleçao:</label><input class='form-control' id='nome_colecao' name='nome_colecao' placeholder='Nome coleção' type='text' required>
                        <br><input class='form-control' type='submit' value='Cadastrar' id='btncole' name='btncole'>
                </form>
                <form id='cadasttecido' autocomplete='off'  method='POST' action=''>
                    <h2>Cadastrar Tecido</h2>
                    <label>Nome Tecido</label><input class='form-control' id='nome_tecido' name='nome_tecido' type='text' placeholder='Nome tecido' required>
                    <label>Composição</label><input class='form-control' id='composicao' name='composicao' type='text' placeholder='Composição' required>
                    <label>Cor -</label>
                    <label>Quantidade</label>
                    <input class='form-control' type='button' id='btnAdd' name='btnAdd' value='adicionar' onclick='addlabel()'>
                    <div id='aqui'>
                    </div>
                    <label>Fornecedor</label><input class='form-control' id='fonecedor' name='fornecedor' type='text' placeholder='Fornecedor do tecido' required>
                    <label>Valor p/metro</label><input class='form-control' id='valor' name='valor' type='number' placeholder='R$/m' step='any' required>
                    <input class='form-control' type='number' id='aqui2' name='aqui2' value='' style='visibility: hidden'>
                    <input class='form-control' type='submit' value='Enviar' id='btntecido' name='btntecido'>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
            </div>
        </div>
    </div>
    </div>
    
";

conferir_refresh();
cdstfunc();
cdsttecido();
cdstcolecao();
?>

