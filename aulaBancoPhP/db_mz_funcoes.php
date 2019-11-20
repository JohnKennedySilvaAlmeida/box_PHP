<?php function exibir_card($nome, $endereco){ ?>

    <div class="col s12 m4 l3">
      <div class="card">
        <div class="card-image">
          <img src="http://lorempixel.com/640/480/transport">
          <span clas="card-title"><?= $nome ?></span>
        </div>
        <div class="card-content">
          <p><?= $endereco ?></p>
        </div>
        <div class="card-action">
          <a href="#">This is a link</a>
        </div>
      </div>
    </div>

<?php } ?>

<?php 
  function cards_principal(){

    require("db_conectar.php");

    $cat = filter_input(INPUT_GET, "cat",FILTER_SANITIZE_NUMBER_INT);
    
    if ($cat >= 1){
      $sql = "SELECT * FROM usuario WHERE cod_categoria = :cat LIMIT :qtd OFFSET :ini";

      $stmt = $conexao->prepare($sql);
      $stmt->bindValue(':cat', $cat, PDO::PARAM_INT);
    }else{
      $sql = "SELECT * FROM usuario LIMIT :qtd OFFSET :ini";
      $stmt = $conexao->prepare($sql);
    }
    $stmt->bindValue(':qtd', 10, PDO::PARAM_INT);
    $stmt->bindValue(':ini', 0, PDO::PARAM_INT);
    if($stmt->execute()) {
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container">';
        echo '<div class="row">';
        foreach ($resultado as $campo) {
            exibir_card($campo['nome'], $campo['end']);
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "Erro na consulta: " . $stmt->errorCode();
    }
    
    $conexao=null; // fechar conexão;
    $stmt=null;
    $resultado=null;
  } 
?>