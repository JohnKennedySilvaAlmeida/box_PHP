<?php 
require_once("db_conectar.php");   // bd

require("inc_cabecalho.php");    // cabecalho 

require("db_mz_funcoes.php");  // funcoes


$sql = "SELECT * FROM usuario LIMIT :qtd OFFSET :ini";

$stmt = $conexao->prepare($sql);
$stmt->bindValue(':qtd', 10, PDO::PARAM_INT);
$stmt->bindValue(':ini', 0, PDO::PARAM_INT);

if($stmt->execute()) {
    
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="container">';
    echo '<div class="row">';
    //require("db_mz_menulateral.php");
    foreach ($resultado as $campo) {
    //echo $campo['cod'] . " - " . $campo['nome']. '<br>';
        exibir_card($campo['nome'], $campo['end']);          /// exibe card!!!!!   nome e endereco 
    }
    echo "</div>";
    echo "</div>";
} else {
    echo "Erro na consulta: " . $stmt->errorCode();
}
$conexao=null; // fechar conexão;

require("inc_rodape.php");  // rodapé 
?>