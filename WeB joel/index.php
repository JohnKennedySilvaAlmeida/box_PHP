<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>_Joel_</title>
</head>

<body id="corpoIndex">

  <div class="text-center">
    <h1 id="cabeçalho">Bem vindo ao 'www.joel.com'</h1>
  </div>

  <div class="container-fluid">
    <div class="row d-flex justify-content-around">
      <div class="col-4 ml-4">
        <h2>Login</h2>
      </div>
      <div class="col-4 ml-4">
        <h2>Cadastre-se!</h2>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row d-flex justify-content-around">
      <div class="col-4">
        <!-- <form class="container" id="loginForm" name="loginForm" action="index.php" method="POST"> -->
          <div class="form-group">
            <label for="userLogin"><strong>Usuario:</strong></label>
            <input type="text" class="form-control preencher" id="userLogin" placeholder="Insira seu usuario:" name="usuarioL">
          </div>
          <div class="form-group">
            <label for="senhaLogin"><strong>Senha:</strong></label>
            <input type="password" class="form-control preencher" id="senhaLogin" placeholder="Insira sua senha:" name="senhaL">
          </div>
          <div class="d-flex flex-row-reverse">
            <div class="col-2">
              <button type="submit" id="btnLogin" class="btn btn-dark" onclick="validarLogin()">Logar</button>
            </div>
          </div>
        <!-- </form>  -->
      </div>

      <div class="col-4">
        <form class="container" id="cadastroForm" name="cadastroForm" action="#">
          <div class="form-group">
            <label for="Nome"><strong>Nome:</strong></label>
            <input type="text" class="form-control preencher" id="Nome" placeholder="Insira seu nome:" name="nome">
            
          </div>
          <div class="form-group">
            <label for="userLogin"><strong>Usuario:</strong></label>
            <input type="text" class="form-control preencher" id="userLogin" placeholder="Insira seu usuario:" name="usuario">
          </div>
          <div class="form-group">
            <label for="senhaLogin"><strong>Senha:</strong></label>
            <input type="password" class="form-control preencher" id="senhaLogin" placeholder="Insira sua senha:" name="senha">
          </div>
          <div class="d-flex flex-row-reverse">
            <div class="col-3">
              <button type="submit" id="btnCadastro" class="btn btn-dark" onclick="validarCadastro()">Cadastrar</button>
            </div>
          </div>
        </form> 
        
      </div>
    </div>
  </div>

</body>
</html>

<script>
  function validarLogin(){
    var usuario = $('#userLogin').val();
    //document.querySelector('#UserLogin').value...
    var senha = $('#senhaLogin').val();
    var regex = /[^\w\s]/g;
    //Usuário
    if(usuario.search(regex)!=-1){
      alert("Campo 'Usuario' não aceita caracteres especiais nem espaços!");
      return;
    } 
    /*
    if(document.loginForm.usuarioL.value.length<5||usuario==""){
      alert("Usuario com menos de 5 letras! Tente novamente!");
      document.loginForm.usuarioL.focus();
      return;
    }
    //Senha
    if(senha.search(regex)!=-1){
      alert("Campo 'Senha' não aceita caracteres especiais nem espaços!");
      document.loginForm.senhaL.focus();
      return;
    } 
    if(document.loginForm.senhaL.value.length<6||senha==""){
      alert("Senha com menos de 6 digitos! Tente novamente!");
      document.loginForm.senhaL.focus();
      return;
    }
    */
    $.post("retrieve_index.php", {usuario :usuario, senha: senha} ,function( data ) {
    if (data.length){
      alert(data);
      return false;
    }
    window.location = "home.php"
    });
  } 
</script>




<script>
   
   /*
  
  function validarCadastro(){
    var nome = document.cadastroForm.nome.value;
    var usuario = document.cadastroForm.usuario.value;
    var senha = document.cadastroForm.senha.value;
    //Nome
    var regex = /[^\w\s]/g;
    if(nome.search(regex)!=-1){
      alert("Campo 'Nome' não aceita caracteres especiais!");
      document.cadastroForm.nome.focus();
      return;
    }
    if(document.cadastroForm.nome.value.length<4||usuario==""){
      alert("Nome com menos de 4 letras! Tente novamente!");
      document.cadastroForm.nome.focus();
      return;
    } 
    //Usuário
    regex = /[^\w]/g;
    if(usuario.search(regex)!=-1){
      alert("Campo 'Usuario' não aceita caracteres especiais nem espaços!");
      document.cadastroForm.usuario.focus();
      return;
    } 
    if(document.cadastroForm.usuario.value.length<5||usuario==""){
      alert("Usuario com menos de 5 letras! Tente novamente!");
      document.cadastroForm.usuario.focus();
      return;
    }
    //Senha
    regex = /[^\w\s]/g;
    if(senha.search(regex)!=-1){
      alert("Campo 'Senha' não aceita caracteres especiais nem espaços!");
      document.cadastroForm.senha.focus();
      return;
    } 
    if(document.cadastroForm.senha.value.length<6||senha==""){
      alert("Senha com menos de 6 digitos! Tente novamente!");
      document.cadastroForm.senha.focus();
      return;
    }
  } 
  */
</script>

