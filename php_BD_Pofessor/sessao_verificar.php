<?php
session_start();
if (isset($_SESSION['id'])) {
    $nome = $_SESSION['id'];
    echo "No outro arquivo foi digitado: $nome";
} else {
    echo "Nenhuma sessao gravada";
}
?>
<br><a href="sessao_inicio.php">Gravar sessao</a>";
<br><a href="sessao_excluir.php">Excluir a sessao</a>";