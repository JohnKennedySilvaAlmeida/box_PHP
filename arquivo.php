<?php 

    $str="teste\r\n"; 			//texto a ser gravado
    $arq=fopen("teste.txt","a+"); 	//abre p/add
    fputs($arq, $str); 			//Insere o texto
    fclose($arq);				// fecha o arquivo.
    $arq=fopen("teste.txt","r");		//Abre p/leitura.
    fpassthru($arq);			//Exibe conteúdo
    fclose($arq);				//fecha o arquivo   
    
?>