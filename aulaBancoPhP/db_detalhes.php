<?php 
require_once("db_conectar.php"); // BD

$cod = filter_input(INPUT_GET, "cod",FILTER_SANITIZE_NUMBER_INT);

if ($cod >=1) { // Id > 1 do BD
    $sql = "SELECT * FROM usuario WHERE cod = :cod";

    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cod', $cod);
    
    if($stmt->execute()) {
        
        $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($stmt->rowCount()) {

            foreach ($resultado as $campo) {
                echo $campo['cod'] . " - " . $campo['nome']. '<br>'; // codigo e nomes BD
            }
        }else{
            echo "<br>Registro nao encontrado!<br>";
        }
        echo '<a href="db_procurar.php">Exibir todos os resultados</a>';
    } else {            // procurar !!
        echo "Erro: " . $stmt->errorCode();
    }    
}else {
    echo "Codigo invalido";
}