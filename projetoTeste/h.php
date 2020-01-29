<?php
//INICIO A SESSÃO
session_start();
//Verifico se o usuário está logado no sistema
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
header("Location: l.php");
}
else {
echo "<h1>Seja bem-vindo, ".$_SESSION["user"]."</h1>";
}
?>

<form action="s.php" method="post">
    <button type="submit">sair</button>
</form>