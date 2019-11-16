<?
session_name("MeuLogin");
session_start();

if($_GET['acao'] == "logar") {
    $conn = mysql_connect("localhost","root","123") ; //configure os dados do seu MySQL
    $banco = mysql_select_db("comercio"); //coloque o nome do seu banco de dados

    $nome = $_POST['nome'];
    $q_user = mysql_query("SELECT * FROM usuarios WHERE login='$nome'");

    if(mysql_num_rows($q_user) == 1) {

        $query = mysql_query("SELECT * FROM usuarios WHERE login='$nome'");
        $dados = mysql_fetch_array($query);
        if($_POST['pwd'] == $dados['senha'] AND $nome == 'admin') {
            session_register("qwert");
            $_SESSION["qwert"]=$nome;
            header("Location: admin/admin.php");
            exit;
        }
        if($_POST['pwd'] == $dados['senha']) {
            session_register("qwert");
            $_SESSION["qwert"]=$nome;
            header("Location:index.php");
            exit;
        }
         else {
            header("Location: login.php?login=falhou&causa=".urlencode('Senha Errada'));
            exit;
        }
    } else {
        header("Location: login.php?login=falhou&causa=".urlencode('User Inválido'));
        exit;
    }
}

//agora a parte que verifica se o login já foi feito
if(session_is_registered("nome") == false) {
    header("Location: login.php");
}
?>

