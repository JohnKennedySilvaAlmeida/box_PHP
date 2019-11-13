<?php 

    session_start();

    if (isset($_SESSION['id'])) {
        
        $nome = $_SESSION['id'];
        echo" No outro arquivo foi digitado: $nome";
    }else {
        echo" Nenhuma sessão gravada";
    }
?> 

<br><a href="sessao_inicio.php">Gravar sessão</a>
<br><a href="sessao_excluir.php">Excluir sessão</a>
