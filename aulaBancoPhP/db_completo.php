<?php

$atualizado = filter_input(INPUT_GET, "atualizado",FILTER_SANITIZE_NUMBER_INT);

    if ($atualizado == 1) {
        ?>
        <script>
            alert('Registro atualizado com Sucesso!!')
        </script>

    <?php
    }       
?>

<!-- <script>
    alert('Registro atualizado com Sucesso!!')
</script> -->


<form action="db_procurar.php" method="post">
    Nome: <input type="text" name="nome">
    <input type="submit" value="Enviar" name="enviar">
</form>

<?php 

echo '<br><a href="db_incluir.php">[Novo Registro]</a> <br>';
require_once("db_conectar.php");

$nome = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($nome) {
    $sql = "SELECT * FROM usuario WHERE nome LIKE :nome";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', '%' . $nome . '%');
}else {
    $sql = "SELECT * FROM usuario LIMIT :qtd OFFSET :ini";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':qtd', 10, PDO::PARAM_INT);
    $stmt->bindValue(':ini', 0, PDO::PARAM_INT);
}
// echo "<script>";
// echo "function del(cod) {  
//     if (confirm(\'Excluir a categoria?\')) {  
//         location.href=\'db_excluir.php?cod=\' + cod;
//     }
// }";
// echo "</script>";

if($stmt->execute()) {

    $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

    if ($stmt->rowCount()) {
        foreach ($resultado as $campo) {
            $cod = $campo['cod'];
            $nome = $campo['nome'];
            echo "$cod - $nome";
            echo " <a href=db_detalhes.php?cod=$cod> [Detalhe]</a>";
            echo " <a href=db_editar.php?cod=$cod> [Editar]</a>";
            //echo " <a href=\"#\" onclick=\"del($cod)\"> [Excluir]</a> <br>";
            echo " <a href=db_excluir.php?cod=$cod> [Excluir]</a> <br>";
        }
    }else{
        echo "<br>Registro nao encontrado!<br>";
        echo '<a href="db_procurar.php">Exibir todos os resultados</a>';
    }
} else {
    echo "Erro: " . $stmt->errorCode();
}