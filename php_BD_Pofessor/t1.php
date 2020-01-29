<?php
  session_start();

  require ('t3.php');
?>

<form method="post" action="t3.php">
  <h5>Login</h5>
  <label>Usuário</label>
  <input type="text" name="usuario" id="usuario" maxlength="50" />
  
  <label>Senha</label>
  <input type="password" name="senha" id="senha" maxlength="50" />
  
  <input type="submit" value="Entrar" />
</form>