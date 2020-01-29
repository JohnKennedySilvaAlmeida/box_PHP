<?php
  session_start();

  require ('t3.php');
?>

<form method="post" action="t3.php">
  <h5>Cadastro</h5>

  <label>nome</label>
  <input type="text" id="nomeC"name="nomeC" maxlength="50" />

  <label>Usuário</label>
  <input type="text" id="usuarioC"name="usuarioC" maxlength="50" />
  
  <label>Senha</label>
  <input type="password" name="senhaC" id="senhaC" maxlength="50" />
  
  <input type="submit" value="Entrar" />
</form>