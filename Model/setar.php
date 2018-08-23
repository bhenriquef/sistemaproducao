<?php
$colecao = ""; $etapas = ""; $lista = ""; $cadastrar = "";
$css = "../../css/"; $js = "../../js/"; $index = "";

if($posi == "cadastrar"){

    $colecao = "../colecao/"; $etapas = "../etapas/";
    $lista = "../lista/"; $index = "../home/";
}
else if($posi == "colecao"){
    $cadastrar = "../cadastrar/"; $etapas = "../etapas/";
    $lista = "../lista/"; $index = "../home/";
}
else if($posi == "etapas"){
    $lista = "../lista/"; $index = "../home/";
    $cadastrar = "../cadastrar/"; $colecao = "../colecao/";
}
else if($posi == "lista"){
    $cadastrar = "../cadastrar/"; $colecao = "../colecao/";
    $etapas = "../etapas/"; $index = "../home/";
}
else if($posi == "index"){
    $cadastrar = "../cadastrar/"; $colecao = "../colecao/";
    $etapas = "../etapas/";
}
?>