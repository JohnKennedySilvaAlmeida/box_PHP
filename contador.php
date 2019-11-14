<?php 
  if (file_exists("contador.txt")){	    	$arq=fopen("contador.txt","r");
    $visitas=fgets($arq,100); 	//Verificar num. de visitas atual
    $visitas++; 			// Incrementar visitas
    fclose($arq);
    }else{
    $visitas=1; 	//caso não exista arq, esta é a primeira visita
    }
    //atualizar o numero de visitas
    $arq=fopen("contador.txt","w");
    //Escrever o total das visitas no arquivo.
    fputs($arq,$visitas);
    fclose($arq); 
    echo "Total de visitantes: $visitas";
?>