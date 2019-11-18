<!DOCTYPE html>

<html lang="pt-br">



<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />

  <title>Cadastrar-se</title>



  <!-- CSS  -->

  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />

  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

  <link rel="shortcut icon" href="images/favicon (8).ico" type="image/x-icon">

  <link rel="icon" href="images/favicon (8).ico" type="image/x-icon">



</head>



<body>

  <br>

  <div class="container">

    <label for="Nome">Nome:</label>

    <input placeholder="" id="first_name" type="text" class="validate" />

    <label for="last_name">Sobrenome</label>

    <input id="last_name" type="text" class="validate" />



    <label for="last_name">CPF/CNPJ</label>

    <input id="last_name" type="text" class="validate" />



    <label for="password">Senha:</label>

    <input id="password" type="password" class="validate" />



    <label for="email">Email:</label>

    <input id="email" type="email" class="validate" />



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <!-- Adicionando Javascript -->

    <script type="text/javascript">

      function limpa_formulário_cep() {

        //Limpa valores do formulário de cep.

        document.getElementById('rua').value = ("");

        document.getElementById('bairro').value = ("");

        document.getElementById('cidade').value = ("");

        document.getElementById('uf').value = ("");

        document.getElementById('ibge').value = ("");

      }



      function meu_callback(conteudo) {

        if (!("erro" in conteudo)) {

          //Atualiza os campos com os valores.

          document.getElementById('rua').value = (conteudo.logradouro);

          document.getElementById('bairro').value = (conteudo.bairro);

          document.getElementById('cidade').value = (conteudo.localidade);

          document.getElementById('uf').value = (conteudo.uf);

          document.getElementById('ibge').value = (conteudo.ibge);

        } //end if.

        else {

          //CEP não Encontrado.

          limpa_formulário_cep();

          alert("CEP não encontrado.");

        }

      }



      function pesquisacep(valor) {



        //Nova variável "cep" somente com dígitos.

        var cep = valor.replace(/\D/g, '');



        //Verifica se campo cep possui valor informado.

        if (cep != "") {



          //Expressão regular para validar o CEP.

          var validacep = /^[0-9]{8}$/;



          //Valida o formato do CEP.

          if (validacep.test(cep)) {



            //Preenche os campos com "..." enquanto consulta webservice.

            document.getElementById('rua').value = "...";

            document.getElementById('bairro').value = "...";

            document.getElementById('cidade').value = "...";

            document.getElementById('uf').value = "...";

            document.getElementById('ibge').value = "...";



            //Cria um elemento javascript.

            var script = document.createElement('script');



            //Sincroniza com o callback.

            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';



            //Insere script no documento e carrega o conteúdo.

            document.body.appendChild(script);



          } //end if.

          else {

            //cep é inválido.

            limpa_formulário_cep();

            alert("Formato de CEP inválido.");

          }

        } //end if.

        else {

          //cep sem valor, limpa formulário.

          limpa_formulário_cep();

        }

      };

    </script>



    <!--  Scripts-->

    <?php include("inc_scripts.php"); ?>



    </head>



    <body>

      <!-- Inicio do formulario -->

      <form method="get" action=".">

        <label>Cep:

          <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" /></label><br />

        <label>Rua:

          <input name="rua" type="text" id="rua" size="60" /></label><br />

        <label>Bairro:

          <input name="bairro" type="text" id="bairro" size="40" /></label><br />

        <label>Cidade:

          <input name="cidade" type="text" id="cidade" size="40" /></label><br />

        <label>Estado:

          <input name="uf" type="text" id="uf" size="2" /></label><br />

      </form>

  </div>




</body>



</html>