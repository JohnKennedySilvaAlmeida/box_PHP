<?php
session_start();
if (!$_SESSION['autenticado']){
  include_once "index.php";
  exit("<div class='alert alert-danger col-sm-12'>Para acessar o sistema você deve efetuar login</div>");
}
?>
<form class="form-horizontal" action="principal.php?q=1b" method="post">
<fieldset>

<!-- Form Name -->
<legend>Novo Contato</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-5">
  <input id="nome" name="nome" placeholder="Nome completo" class="form-control input-md" required type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefone">Telefone</label>  
  <div class="col-md-4">
  <input id="telefone" name="telefone" placeholder="(99) 99999-9999" class="form-control input-md" required type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" placeholder="email" class="form-control input-md" required type="text">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="salvar"></label>
  <div class="col-md-8">
    <button id="salvar" name="salvar" class="btn btn-success" type="submit"  >&nbsp;Salvar&nbsp;</button>
    <a href="principal.php" id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</a>
  </div>
</div>

</fieldset>
</form>