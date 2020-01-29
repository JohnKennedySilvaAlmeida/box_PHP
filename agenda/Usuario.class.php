<?php
class Usuario {
  const USUARIO = "root";
  const SENHA = "SENHA";
  
  public function conecta() {
    $con = new PDO("mysql:host=localhost;dbname=agenda", self::USUARIO,self::SENHA);
	  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
  }
  public function confere($us,$se) {
    $con = $this->conecta();
    $stm = $con->prepare("select * from usuarios where usuario=? and senha=password(?)");
    $stm->bindParam(1,$us);
    $stm->bindParam(2,$se);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return count($dados);
     
  }
}
?>