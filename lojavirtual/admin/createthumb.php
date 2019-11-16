<?php

/*
* 
* Script's name: Thumbnails' creator
* Nome do script: Criador de miniaturas
* 
* Author / Autor: Luciano Vittoretti Leite
* WWW: http://www.vittoretti.com.br
* MSN/e-mail: luciano@vittoretti.com.br
* ICQ: 39494066
* São Paulo / SP / Brazil
* 
* Requirements:
* This script requires GD Lib declared on your php.ini.
* For more information: http://www.php.net/image
* 
* In case GD Lib isn't installed this script will only
* redirect your browser to the file image in natural size.
* 
* Requisitos:
* Esse script precisa da bibliotece GD declarada no seu php.ini.
* Para mais informações: http://www.php.net/image
* 
* Se a biblioteca GD não estiver instalada esse script
* vai redirecionar seu navegador para o arquivo da
* imagem em tamanho natural.
* 
* Examples / Exemplos:
* <img src="createthumb.php?image=filename.jpg">
* <img src="createthumb.php?image=filename.jpg&max=200">
* 
*  - Parameters / Parâmetros:
*    * max   - especify the size of width or height, witch are
*              greater.
*            - especifica o tamanho da largura ou altura, qual
*              for maior.     
*  
*    * image - especity the image's file that will be created
*              a thumbnail. In case of invalid informed file,
*              will be showed an error message in a image.
*            - especifica a arquivo de imagem que será criado
*              uma miniatura. Se o arquivo informado for
*              inválido, será exibida uma mensagem de erro em
*              uma imagem.
* 
* Do you like? Hate it? Contact me.
* Você gostou? Odiou? Entre em contato.
*  
* Luciano Vittoretti Leite
* 
*/

if ( isset( $HTTP_GET_VARS["image"] ) ) {
	$image = $HTTP_GET_VARS["image"];
} else {
	echo "Parâmetro \"image\" faltando.<BR>";
	echo "Parameter \"image\" missing.";
	exit;
} 

if ( isset( $HTTP_GET_VARS["max"] ) ) {
	$max = $HTTP_GET_VARS["max"];
} else {
	$max = "100";
} 

if ( !function_exists( "imagecreatefromstring" ) ) {
	header( "location: $image" );
	exit;
} 

$im = @imagecreatefromstring( @fread( @fopen( $image, "r" ), @filesize( $image ) ) );

if ( !strlen( $im ) ) {
	$im = imagecreate ( $max, $max );

	$bgc = imagecolorallocate ( $im, 255, 255, 255 );
	$tc = imagecolorallocate ( $im, 0, 0, 0 );
	imagefilledrectangle ( $im, 0, 0, 150, 30, $bgc );

	imagestring ( $im, 2, 3 , 15, "Erro ao carregar", $tc );
	imagestring ( $im, 2, 18, 30, "miniatura.", $tc );

	imagestring ( $im, 2, 10, 55, "Error on load", $tc );
	imagestring ( $im, 2, 18, 70, "thumbnail.", $tc );

	header( "Content-type: " . image_type_to_mime_type( IMAGETYPE_PNG ) );
	echo imagepng( $im );
	exit;
} 

$largura = imagesx( $im );
$altura = imagesy( $im );

if ( $largura >= $altura ) {
	if ( $largura > $max ) {
		$naltura = ( $max / $largura ) * $altura;
		$nlargura = ( $max / $largura ) * $largura;
	} 
} else {
	if ( $altura > $max ) {
		$nlargura = ( $max / $altura ) * $largura;
		$naltura = ( $max / $altura ) * $altura;
	} 
} 

if ( function_exists( 'imagecopyresampled' ) ) {
	if ( function_exists( 'imageCreateTrueColor' ) ) {
		$ni = imageCreateTrueColor( $nlargura, $naltura );
	} else {
		$ni = imagecreate( $nlargura, $naltura );
	} 
	if ( !@imagecopyresampled( $ni, $im, 0, 0, 0, 0, $nlargura, $naltura, $largura, $altura ) ) {
		imagecopyresized( $ni, $im, 0, 0, 0, 0, $nlargura, $naltura, $largura, $altura );
	} 
} else {
	$ni = imagecreate( $nlargura, $naltura );
	imagecopyresized( $ni, $im, 0, 0, 0, 0, $nlargura, $naltura, $largura, $altura );
} 

header( "Content-type: " . image_type_to_mime_type( IMAGETYPE_JPEG ) );
echo imagejpeg( $ni, null, 70 );
exit;

?>
