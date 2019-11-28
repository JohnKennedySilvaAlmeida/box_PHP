
<?php 
  
  include("db_mz_funcoes.php");
//   validar_sessao();
//   usuario_logado();
?>  

<!-- Faz a validação se podemos excluir o registro -->
<script>
    function del(cod) {  
        if (confirm('Excluir a registro?')) {  
            location.href='db_excluir.php?cod=' + cod;
        }
    }
</script>



<!DOCTYPE html>
  <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Blog</title>

        <!-- Google Icon Font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- materialize.css -->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!-- CSS Customizado -->
        <link rel="stylesheet" href="css/customizado.css">
        
        <!-- viewport para mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>



<nav>
    <div class="nav-wrapper black">
      <a href="#!" class="brand-logo center ">Blog / Adm</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
        <li><a href="home.php">Sair</a></li>
        <!-- <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li> -->
      </ul>
    </div>
</nav>




<form class="container" action="db_procurar.php" method="post">
    Procurar arquivo (Nome): <input type="text" name="nome">
    <input type="submit" value="Enviar" name="enviar">
</form>

<?php 








echo '<br><a href="db_incluir.php">[Novo Registro]</a> <br>';

require_once("db_conectar.php");

$nome = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($nome) {
    $sql = "SELECT * FROM usuarios WHERE nome LIKE :nome";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', '%' . $nome . '%');
}else {
    $sql = "SELECT * FROM usuarios LIMIT :qtd OFFSET :ini";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':qtd', 10, PDO::PARAM_INT);
    $stmt->bindValue(':ini', 0, PDO::PARAM_INT);
}

if($stmt->execute()) {
    $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
    if ($stmt->rowCount()) {

        foreach ($resultado as $campo) {
            $cod = $campo['cod'];
            $nome = $campo['nome'];
            echo "$cod - $nome";
            echo " <a href=db_detalhes.php?cod=$cod> [Detalhe]</a>";
            echo " <a href=db_editar.php?cod=$cod> [Editar]</a>";
            echo " <a href=\"#\" onclick=\"del(${cod})\"> [Excluir]</a> <br>";
        }
    }else{
        echo "<br>Registro nao encontrado!<br>";
        echo '<a href="db_procurar.php">Exibir todos os resultados</a>';
    }
} else {
    echo "Erro: " . $stmt->errorCode();
}


include("inc_rodape.php");


?>
