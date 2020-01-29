<?php
class Contato {
  const USUARIO = "root";
  const SENHA = "SENHA";
  public function conectar() {
    $con = new PDO("mysql:host=localhost;dbname=agenda", self::USUARIO,self::SENHA);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
  }
  public function novo($nome,$email,$telefone,$responsavel){
    $con = $this->conectar();
    $stm = $con->prepare("insert into contatos (nome,email,telefone,responsavel) values (?,?,?,?)");
    $stm->bindParam(1,$nome);
    $stm->bindParam(2,$email);
    $stm->bindParam(3,$telefone);
    $stm->bindParam(4,$responsavel);
    $stm->execute();
    
  }
}
?>