<form action="upload.php" method="POST" enctype="multipart/form-data">
    Enviar arquivo:
    <input type="file" name="arquivo">
    <input type="submit" name="enviar" value="Enviar">
</form>

<?php
//Verificar se o formulario foi enviado
if(!isset($_POST["enviar"])){
    exit;
}
$nome = (isset($_FILES['arquivo']['name'])) ? $_FILES['arquivo']['name'] : false ;
$tipo = (isset($_FILES['arquivo']['type'])) ? $_FILES['arquivo']['type'] : false ;
$tamanho = (isset($_FILES['arquivo']['size'])) ? $_FILES['arquivo']['size'] : false ;
$temp = (isset($_FILES['arquivo']['tmp_name'])) ? $_FILES['arquivo']['tmp_name'] : false ;
$erro = (isset($_FILES['arquivo']['error'])) ? $_FILES['arquivo']['error'] : false ;
if ($erro != 0) {
    echo "Nao foi possivel realizar o upload para o servidor.<br>";
    echo "Foi encontrado o erro $erro";
    exit;
}
if ($tamanho > 500000){
	echo "Arquivo muito grande. Tamanho maximo permitido 500 KB. ";
	echo "<br>O arquivo enviado contem " . round($tamanho/1024) . "KB"; 
	exit; 
}
if ($tipo <> "image/png"){
    echo "Apenas arquivos PNG são permitidos!";
    exit; 
}
$dir = "upload/";
if (!file_exists($dir)) {
	mkdir($dir, 0755) or die("Não foi possivel criar a pasta upload/");
}
$nome_novo = date('YmdHis') . ".png";
$caminho = $dir . $nome_novo;
if (move_uploaded_file($temp,$caminho)){
	echo "Upload efetuado com sucesso!";
	echo "<img src=$caminho>";
}else{
	echo "Problema no upload do arquivo"; exit;}
?>