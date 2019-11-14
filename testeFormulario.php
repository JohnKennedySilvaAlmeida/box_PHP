<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login Gestão Central</title>
</head>
<body>
    <style>
        .container{margin-top: 150px}
        button {
            width:48%;
            background-color:p;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            outline: none;
            padding: 5px;
            border-radius: 5px;
            font-size: 17px;
            color: white;
            background-color: #80179b;
            font-family: 'Cairo', sans-serif;
            top: 50%;
            left: 50%;
            top: 50%;
            left: 50%;
        }
        .titulo
        {
            font-family: 'Cairo', sans-serif;
            font-size: 35px;
            text-align: center;
            font-weight: 700;
            color: #80179b;
        }
    </style>
    <div class="container text-center">
        <div class="col-lg-3 offset-lg-4">
            <form>
                <div class="form-group">
                    <h1 class="titulo">Entre</h1>
                    <input type="username" class="form-control" id="usuario" aria-describedby="usuario" placeholder="Seu login">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="senha" aria-describedby="senha" placeholder="Sua senha">
                </div>
            </form>
            <button type="submit" id="login">Login</button>
            <a href="cadastro.html"><button>Cadastre-se</button></a>
            <div class="mt-5" id="output"></div>
        </div>
    </div>
    <script>
        document.getElementById('login').addEventListener('click', login)
        function login() {
            var usuario = document.getElementById("usuario").value;
            var senha = document.getElementById("senha").value;
            if (usuario == '') { alert("Usuário não informado"); }
            if (senha == '') { alert("Senha não informada"); stopPropagation(); }
            fetch('users.json')
                .then((res) => res.json())
                .then((dados) => {
                    dados.forEach(function(usuarios){
                        if(usuario == usuarios.usuario && senha == usuarios.senha){
                            alert(usuarios.usuario + " entrou");
                        }
                    });
                })
        }
    </script>
</body>
</html>