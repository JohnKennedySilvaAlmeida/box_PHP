<?$host = "localhost";
$user = "root";
$senha = "123";
$dbname = "comercio";
$conexao = mysql_connect($host, $user, $senha) or die("Usuario e senhas nao conferem");
mysql_select_db($dbname)or die("Não foi possível conectar-se com o banco de dados");
 ?>


