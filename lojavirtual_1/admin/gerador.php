<? 
######################################################### 
# Script desenvolvido por Leonardo Teixeira        	# 
# Por favor!!!! você pode mudar a vontade        	# 
# Mas deixe os meus Creditos                		# 
#  www.nossoportifolio.com.br                		# 
######################################################### 

header("Content-type: image/jpeg"); 
$imagem = $_GET['imagem']; 
$largura = 50; //aqui você poderá mudar a Largura
$altura  = 50; //aqui você poderá mudar a altura
$imagem_orig     =   ImageCreateFromJPEG($imagem); 

//LARGURA 
$pontoX          =   ImagesX($imagem_orig); 
//ALTURA 
$pontoY          =   ImagesY($imagem_orig); 
$imagem_fin    =   ImageCreateTrueColor($largura, $altura); 
ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY); 

ImageJpeg($imagem_fin,'',100); 

?> 

