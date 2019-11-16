<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cadastro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <style>
        /*:not(path):not(g) {
                    color: hsla(210, 100%, 100%, 0.9) !important;
                    background: hsla(210, 100%, 50%, 0.5) !important;
                    outline: solid 0.25rem hsla(210, 100%, 100%, 0.5) !important;
                    box-shadow: none !important;
                } */
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="text-center mb-5 mt-5">
            <h1 class="title">Cadastro</h1>
            <p>Por favor, preencha todos os campos abaixo.<br>Esse cadastro já é meio caminho andado para utilizar o
                Gestão Central!</p>
        </div>
        <!-- The carousel -->
        <div id="myCarousel" class="carousel slide" data-interval="false">

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active" id="1">
                    <div class="col-md-4 col-sm-12 offset-lg-4 offset-md-4 mb-3 form-style" id="meuForm">

                        <label class="titulo">Nome</label>
                        <input class="form-control" type="text" name="Nome" id="nome" onblur="validaNome()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Sobrenome</label>
                        <input class="form-control" type="text" name="Sobrenome" id="sobrenome"
                            onblur="validaSobreNome()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Login</label>
                        <input class="form-control col-md-6" type="text" name="Login" id="login" onblur="validaLogin()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Senha</label>
                        <input class="form-control col-md-6 col-sm-6" type="password" name="Senha" id="senha"
                            onblur="validaSenha()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo" required>Confirme sua senha</label>
                        <input class="form-control col-md-6 col-sm-6" type="password" name="confirmasenha"
                            id="confirmaSenha" onblur="validaConfirmaSenha()">
                        <small><span class="helper-text mb-4"></span></small><br>
                    </div>
                </div>

                <div class="carousel-item" id="2">
                    <div class="col-md-4
                                col-sm-12
                                offset-lg-4
                                offset-md-4
                                mb-3
                                form-style">

                        <label class="titulo" for="validationCustom04">CNPJ</label>
                        <input class="form-control" type="text" id="cnpj">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Empresa</label>
                        <input class="form-control mb-3" type="text" id="empresa">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Email</label>
                        <input class="form-control mb-3" type="email" id="email" onblur="validaEmail()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Telefone</label>
                        <input class="form-control mb-3" type="text" id="telefone" onblur="validaTelefone()">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Telefone 2</label>
                        <input class="form-control mb-3" type="text" id="telefone" onblur="validaTelefone()">
                        <small><span class="helper-text mb-4"></span></small><br>
                    </div>
                </div>

                <div class="carousel-item" id="3">
                    <div class="col-md-4 col-sm-12 offset-lg-4 offset-md-4 mb-3 form-style">

                        <label class="titulo" for="validationCustom05">CEP</label>
                        <input class="form-control mb-3" type="text" id="cep" onblur="pesquisacep(this.value);">
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Rua</label>
                        <input class="form-control mb-3" type="text" id="rua" size="60" required>
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo" for="validationCustom04">Bairro</label>
                        <input class="form-control mb-3" type="text" id="bairro" size="40" required>
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo">Cidade</label>
                        <input class="form-control mb-3" name="cidade" type="text" id="cidade" size="40" required>
                        <small><span class="helper-text mb-4"></span></small><br>

                        <label class="titulo" for="validationCustom04">Estado</label>
                        <input class="form-control" name="uf" type="text" id="uf" size="2" required>
                        <small><span class="helper-text mb-4"></span></small><br>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 offset-lg-4 offset-md-4 mb-3">

                <button class="btn btn-md col-sm-9 float-right mb-5" href="#myCarousel" data-slide="next"
                    id="continuar" style="display:inline" type="button">Continuar</button>
                <button class="btn btn-md col-sm-9 float-left mb-5" href="#myCarousel" data-slide="prev"
                    id="voltar" style="display: none">Voltar</button>
                <button class="btn btn-md col-sm-9 float-right mb-5" href="#myCarousel" data-slide="next"
                    id="salvar" style="display: none">Salvar</button>

            </div>
        </div>
    </div>

    <script>
        const nome = document.getElementById('nome');
        const sobrenome = document.getElementById('sobrenome');
        const campoLogin = document.getElementById('login');
        const senha = document.getElementById('senha');
        const confirmaSenha = document.getElementById('confirmaSenha');
        const email = document.getElementById('email');
        const green = '#4CAF50';
        const red = '#F44336';
        // ======================================================== CAROUSEL ======================================================== //
        $(document).ready(function () {
            // Activate Carousel
            $("#myCarousel").carousel();
            // Enable Carousel Indicators
            $(".item1").click(function () {
                $("#myCarousel").carousel(0);
            });
            $(".item2").click(function () {
                $("#myCarousel").carousel(1);
            });
            $(".item3").click(function () {
                $("#myCarousel").carousel(2);
            });
            // Enable Carousel Controls
            $(".carousel-control-next").click(function () {
                $("#myCarousel").carousel("next");
            });
            $(".carousel-control-prev").click(function () {
                $("#myCarousel").carousel("prev");
            });
            $('#myCarousel').on('slide.bs.carousel', function onSlide(ev) {
                var id = ev.relatedTarget.id;
                switch (id) {
                    case "1":
                        document.getElementById("continuar").style.display = "inline";
                        document.getElementById("voltar").style.display = "none";
                        document.getElementById("salvar").style.display = "none";
                        break;
                    case "2":
                        document.getElementById("voltar").style.display = "inline";
                        document.getElementById("continuar").style.display = "inline";
                        document.getElementById("salvar").style.display = "none";
                        break;
                    case "3":
                        document.getElementById("voltar").style.display = "inliine";
                        document.getElementById("continuar").style.display = "none";
                        document.getElementById("salvar").style.display = "inline";
                        break;
                    default:
                }
            })
        });
        // ======================================================== ======== ======================================================== //
        // ========================================================== NOME ========================================================== //
        function validaNome() {
            // check if is empty
            if (verificaSeVazio(nome)) return;
            // is if it has only letters
            if (!verificaSeApenasLetras(nome)) return;
            return true;
        }
        function validaSobreNome() {
            // check if is empty
            if (verificaSeVazio(sobrenome)) return;
            // is if it has only letters
            if (!verificaSeApenasLetras(sobrenome)) return;
            return true;
        }
        function validaLogin() {
            if (verificaSeVazio(campoLogin)) return;
            if (verificaLogin()) return;
            return true;
        }
        function validaSenha() {
            // Empty check
            if (verificaSeVazio(senha)) return;
            // Must of in certain length
            if (!meetLength(senha, 4, 100)) return;
            // check password against our character set
            // 1- a
            // 2- a 1
            // 3- A a 1
            // 4- A a 1 @
            if (!possuiCaracteres(senha, 3)) return;
            return true;
        }
        function validaConfirmaSenha() {
            // If they match
            if (senha.value !== confirmaSenha.value) {
                tornaInvalido(confirmaSenha, 'As senhas devem coincidir');
                return;
            } else {
                tornaValido(confirmaSenha);
            }
            return true;
        }
        function verificaSeVazio(field) {
            if (estaVazio(field.value.trim())) {
                // set field invalid
                tornaInvalido(field, `${field.name} não pode estar vazio`);
                return true;
            } else {
                // set field valid
                tornaValido(field);
                return false;
            }
        }
        function verificaSeApenasLetras(field) {
            if (/^[a-zA-Z ]+$/.test(field.value)) {
                tornaValido(field);
                return true;
            } else {
                tornaInvalido(field, `${field.name} deve conter apenas letras`);
                return false;
            }
        }
        function estaVazio(value) {
            if (value === '') return true;
            return false;
        }
        function tornaValido(field, message) {
            document.getElementById(field.id).style.borderColor = green;
            field.nextElementSibling.innerHTML = '';
            field.nextElementSibling.style.color = green;
        }
        function tornaInvalido(field, message) {
            document.getElementById(field.id).style.borderColor = red;
            field.nextElementSibling.innerHTML = message;
            field.nextElementSibling.style.color = red;
        }
        // ========================================================== ==== ========================================================== //
        // ========================================================== LOGIN ========================================================== //
        function verificaLogin() {
            login = document.getElementById('login').value;
            fetch("http://www.consensu.com.br:8000/usuario?Usuario='" + login + "'")
                .then((res) => res.json())
                .then((dados) => {
                    dados.forEach(function (usuarios) {
                        if (login == usuarios.Usuario) {
                            tornaInvalido(campoLogin, `${campoLogin.name} já foi selecionado`)
                            return false;
                        }
                    });
                })
        }
        function meetLength(field, minLength, maxLength) {
            if (field.value.length >= minLength && field.value.length < maxLength) {
                tornaValido(field);
                return true;
            } else if (field.value.length < minLength) {
                tornaInvalido(
                    field,
                    `${field.name} deve ter no mínimo ${minLength} caracteres`
                );
                return false;
            } else {
                tornaInvalido(
                    field,
                    `${field.name} deve ser mais curta que ${maxLength} caracteres`
                );
                return false;
            }
        }
        function possuiCaracteres(field, code) {
            let regEx;
            switch (code) {
                case 1:
                    // letters
                    regEx = /(?=.*[a-zA-Z])/;
                    return matchWithRegEx(regEx, field, 'Must contain at least one letter');
                case 2:
                    // letter and numbers
                    regEx = /(?=.*\d)(?=.*[a-zA-Z])/;
                    return matchWithRegEx(
                        regEx,
                        field,
                        'Must contain at least one letter and one number'
                    );
                case 3:
                    // uppercase, lowercase and number
                    regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
                    return matchWithRegEx(
                        regEx,
                        field,
                        'Deve conter ao menos uma letra maiúscula, uma letra minúscula e um número!'
                    );
                case 4:
                    // Email pattern
                    regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return matchWithRegEx(regEx, field, 'Must be a valid email address');
                default:
                    return false;
            }
        }
        function matchWithRegEx(regEx, field, message) {
            if (field.value.match(regEx)) {
                tornaValido(field);
                return true;
            } else {
                tornaInvalido(field, message);
                return false;
            }
        }
        //             // ========================================================== ===== ========================================================== //
        //             // ========================================================== SENHA ========================================================== //
        //             document.getElementById('senha').addEventListener('input',validaSenha);
        //             function validaSenha(){
        //                 var senha = document.getElementById('senha').value;
        //                 var chaveSenha = false;
        //                 if(senha.length < 8){
        //                     document.getElementById('senha').style.borderColor = "red";
        //                 } else {
        //                     document.getElementById('senha').style.borderColor = "green";
        //                     chaveSenha = true;
        //                 };
        //             }
        //             // ========================================================== ===== ========================================================== //
        //             // ========================================================== CONFIRMA SENHA ========================================================== //
        //             document.getElementById('confirmaSenha').addEventListener('blur', comparaSenha);
        //             function comparaSenha(){
        //                 var senha1 = document.getElementById('senha').value;
        //                 var senha2 = document.getElementById('confirmaSenha').value;
        //                 var chaveConfirmaSenha = false;
        //                 if(senha1 == senha2){
        //                     document.getElementById('confirmaSenha').style.borderColor = "green";
        //                     chaveConfirmaSenha = true;
        //                 } else {
        //                     document.getElementById('confirmaSenha').style.borderColor = "red";
        //                 };
        //             }
        //     // ========================================================== ======== ===== ========================================================== //
        //     // ========================================================== CNPJ ========================================================== //
        document.getElementById('cnpj').addEventListener('blur', validaCNPJ);
        function validaCNPJ() {
            var cnpj = document.getElementById('cnpj').value;
            cnpj = cnpj.replace(/\D/g, '');
            if (cnpj.length < 11 || cnpj.length > 14) {
                tornaInvalido('cnpj', "CPF/CNPJ inválido! Por favor tente novamente.");
                stopPropagation();
            };
            if (cnpj.length == 11) {
                stopPropagation();
            };
            fetch('https://www.receitaws.com.br/v1/cnpj/' + cnpj)
                .then((res) => res.json())
                .then((dados) => {
                    if (dados.status == "ERROR") {
                        alert("Parece que esse CNPJ não é válido, tente novamente!");
                        stopPropagation();
                    };
                    document.getElementById('empresa').value = (dados.nome);
                    document.getElementById('cep').value = (dados.cep);
                    document.getElementById('rua').value = (dados.logradouro);
                    document.getElementById('bairro').value = (dados.bairro);
                    document.getElementById('cidade').value = (dados.municipio);
                    document.getElementById('uf').value = (dados.uf);
                })
        }
        //     // ========================================================== ==== ========================================================== //
        //     // ========================================================== CEP ========================================================== //
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }
        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
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
        // ========================================================== === ========================================================== //
    </script>

</body>

</html>