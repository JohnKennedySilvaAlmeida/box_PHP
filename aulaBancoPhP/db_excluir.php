<?php 
require_once("db_conectar.php");

$cod = filter_input(INPUT_GET, "cod",FILTER_SANITIZE_NUMBER_INT);

if ($cod >=1) {
    $sql = "DELETE FROM usuario WHERE cod = :cod";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cod', $cod);

    if($stmt->execute()) {
        echo 'Registro excluido com sucesso!<br>';  
        echo '<a href="db_completo.php">Voltar menu principal</a>';
    } else {
        echo "Erro: " . $stmt->errorCode();
    }    
}else {
    echo "Codigo invalido";
}